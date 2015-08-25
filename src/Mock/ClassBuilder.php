<?php

namespace Box\TestScribe\Mock;

use Box\TestScribe\Output;
use ReflectionClass;
use ReflectionMethod;

/**
 * Build classes dynamically for non static invocation only.
 */
class ClassBuilder
{
    const MOCK_CLASS_NAME_PREFIX = '_GEN_MOCK_';

    // The method names used by the generator itself.
    // If the class being mocked defines methods with the same names
    // except the magic methods such as __construct method,
    // these methods calls will not be mocked correctly.
    private static $reservedMethodNames = [
        '__construct',
        '__destruct',
        '__routeAllCallsToTestGeneratorMockObjects',
        '__getUnitTestGeneratorMockInstance'
    ];

    /**
     * @var Output
     */
    private $output;

    /**
     * @param \Box\TestScribe\Output $output
     */
    function __construct(
        Output $output
    )
    {
        $this->output = $output;
    }

    /**
     * Create and load a mock class dynamically.
     * Used for instance invocation only.
     *
     * @param string $uniqueName
     * @param string $classNameBeingMocked
     * @param string $nameOfTheMethodToPassThrough
     *   It tells this instance to pass calls to
     *   this method to the real object of the class being mocked
     *   and continue to mock other methods.
     *
     * @return string the mock class name
     */
    public function create(
        $uniqueName,
        $classNameBeingMocked,
        $nameOfTheMethodToPassThrough
    )
    {
        $mockClassName = self::MOCK_CLASS_NAME_PREFIX . $uniqueName;

        // The class name should be unique.
        // @TODO (ryang 8/28/14) : Optimize. There is no need to
        // create multiple mock classes for a given mocked class.
        $this->createAndLoadDynamicClass(
            $mockClassName,
            $classNameBeingMocked,
            $nameOfTheMethodToPassThrough
        );

        return $mockClassName;
    }

    /**
     * Create the class code dynamically.
     * The class is set up for instance method invocation only.
     * Load the created class.
     * The class name should be unique.
     *
     * @param string $uniqueClassName
     * @param string $baseClassName
     * @param string $nameOfTheMethodToPassThrough
     */
    private function createAndLoadDynamicClass(
        $uniqueClassName,
        $baseClassName,
        $nameOfTheMethodToPassThrough
    )
    {
        $originalClassMethodOverwriteStatements =
            $this->genOriginalMethodsOverwriteStatements(
                $baseClassName,
                $nameOfTheMethodToPassThrough
            );

        $reflectionClass = new \ReflectionClass($baseClassName);
        $isInterface = $reflectionClass->isInterface();
        if ($isInterface) {
            $implementOrExtend = "implements";
        } else {
            $implementOrExtend = 'extends';
        }
        // @TODO (ryang 8/28/14) : support mocking an interface.
        $classDef = <<<EOF
class $uniqueClassName $implementOrExtend $baseClassName
{
    use \\Box\\TestScribe\\Mock\\MockTrait;
    $originalClassMethodOverwriteStatements
}

EOF;

        eval($classDef);
    }

    /**
     * Create the constructor statement for the mocked object.
     *
     * Only invoke real constructor when partial mocking is requested.
     *
     * The constructor always sets the private unitTestGeneratorMockObj
     * field to point to the MockClass instance which is passed in
     * as the first parameter.
     *
     * When partial mocking is requested and the original constructor is defined,
     * the constructor will strip out
     * the first parameter and pass the rest to the original constructor.
     *
     * This field needs to be set in the constructor because it is needed
     * when the class under test's real constructor calls its own protected
     * or public method which are mocked out.
     *
     * @param \ReflectionClass $classBeingMocked
     *
     * @param string $nameOfTheMethodToPassThrough
     *
     * @return string
     */
    private function genConstructorForPartialMocking(
        ReflectionClass $classBeingMocked,
        $nameOfTheMethodToPassThrough
    )
    {
        $firstArgumentName = '$__PhpUnitTestMockObject';
        $argumentToOriginalConstructorVarName = '$argumentsToOriginal';
        $argumentsString = $firstArgumentName;
        $callOriginalConstructorStatement = '';
        if ($nameOfTheMethodToPassThrough !== '') {
            // Only allow the original constructor to be called when 
            // partial mocking is requested.
            $originalConstructor = $classBeingMocked->getConstructor();
            if ($originalConstructor !== null) {
                $originalArgumentString = $this->genArgumentString($originalConstructor);
                if ($originalArgumentString) {
                    $argumentsString .= ', ' . $originalArgumentString;
                }
                $callOriginalConstructorStatement = <<<EOD
\$arguments = func_get_args();
$argumentToOriginalConstructorVarName = array_slice(\$arguments, 1);
call_user_func_array('parent::__construct', $argumentToOriginalConstructorVarName);
EOD;
            }
        }

        $methodDefinition = <<<EOD

public function __construct($argumentsString) {
    \$this->unitTestGeneratorMockObj = $firstArgumentName;
    $callOriginalConstructorStatement
}

EOD;

        return $methodDefinition;
    }

    /**
     * Generate method definition statements that overwrite methods
     * defined in the given base class.
     * This is done so that calls to these methods can be intercepted
     * by this tool. Otherwise calls to these methods will be routed to
     * the original class.
     *
     * @param string $baseClassName
     * @param string $nameOfTheMethodToPassThrough
     *
     * @return string
     */
    private function genOriginalMethodsOverwriteStatements(
        $baseClassName,
        $nameOfTheMethodToPassThrough
    )
    {
        $classBeingMocked = new \ReflectionClass($baseClassName);
        // We only need to overwrite public methods and protected methods
        // private methods can't be mocked by mocking frameworks anyway.
        $methodObjs = $classBeingMocked->getMethods(
            ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED
        );

        // The destructor is overwritten to prevent
        // the original versions to be called.
        // @TODO (ryang 2/17/15) : does it matter if the destructor is called or not?

        // Don't overwrite the original constructor.
        // We want the state of the mock object to resemble the original object
        // to support partial mocking.
        // @TODO (ryang 2/17/15) : re-evaluate when we use this class for all mock objects
        // not only the ones that represent the class under test.
        $overwriteStatement = "\npublic function __destruct(){}\n";

        $constructorStatement = $this->genConstructorForPartialMocking(
            $classBeingMocked,
            $nameOfTheMethodToPassThrough
        );
        $overwriteStatement .= $constructorStatement;

        foreach ($methodObjs as $method) {
            $methodName = $method->getName();

            if ($method->isFinal()) {
                $msg = sprintf(
                    "Warning: Class ( %s ) being mocked has a final method ( %s ).\n" .
                    "Mocking of this method is not supported.\n" .
                    "If this method is called, the result is not defined. ",
                    $classBeingMocked->getName(),
                    $methodName
                );
                $this->output->writeln($msg);
                continue;
            }

            // If the method is static, no need to overwrite it
            // since static methods are not expected to be called in this context.
            if (!($method->isStatic()
                || in_array($methodName, self::$reservedMethodNames, true)
                // Don't intercept the method that is meant to be passed through.
                // This is used to support partial mocking. 
                // We want to invoke the real logic of the method under test. 
                || ($methodName === $nameOfTheMethodToPassThrough))
            ) {
                $overwriteStatement .= $this->genOneMethodOverwriteStatement(
                    $method
                );
            }
        }

        return $overwriteStatement;
    }

    /**
     * Generate the function statement that overwrites the method
     * of the given name.
     * The function will delegate the calls to this method to
     * its internal method.
     *
     * @param ReflectionMethod $method
     *
     * @return string
     */
    private function genOneMethodOverwriteStatement($method)
    {
        $methodName = $method->getName();
        $argumentsString = $this->genArgumentString($method);
        $methodDefinition = <<<EOD

public function $methodName($argumentsString) {
    \$arguments = func_get_args();
    \$rc = \$this->__routeAllCallsToTestGeneratorMockObjects('$methodName', \$arguments);

    return \$rc;
}
EOD;

        return $methodDefinition;
    }

    /**
     * Generate the argument string used by the given method.
     * PHP will overwrite a method defined in the base class
     * based on the method name only.
     * However when the same method is defined in an interface
     * implemented by the class being mocked, PHP will complain
     * if we define the same method with no parameter.
     * e.g. error:
     * Fatal error: Declaration of mockParam0::is_in_enterprise()
     * must be compatible with Collaborator::is_in_enterprise($enterprise)
     * And all the method signatures including type hints and
     * default values have to match.
     *
     * @param ReflectionMethod $method
     *
     * @return string
     */
    private function genArgumentString($method)
    {
        $argumentStrings = [];
        $arguments = $method->getParameters();
        foreach ($arguments as $arg) {
            $typeClass = $arg->getClass();
            if ($typeClass) {
                $typeHintString = $typeClass->getName();
            } elseif ($arg->isArray()) {
                $typeHintString = 'array';
            } elseif ($arg->isCallable()) {
                $typeHintString = 'callable';
            } else {
                $typeHintString = '';
            }
            try {
                $defaultValue = $arg->getDefaultValue();
                $defaultValueString = '= ' . var_export($defaultValue, true);
            } catch (\ReflectionException $e) {
                // There is no default value set for this argument.
                // Since getDefaultValue returns mixed,
                // throwing an exception is the only option to signal this condition.
                $defaultValueString = '';
            }
            $argString = "$typeHintString $" . $arg->getName() . $defaultValueString;
            $argumentStrings[] = $argString;
        }
        $argumentString = implode(', ', $argumentStrings);

        return $argumentString;
    }
}
