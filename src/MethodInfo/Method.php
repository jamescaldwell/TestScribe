<?php

namespace Box\TestScribe\MethodInfo;

use Box\TestScribe\App;
use Box\TestScribe\ClassInfo\PhpClass;
use Box\TestScribe\MethodHelper;
use Box\TestScribe\Parameter;
use Box\TestScribe\PHPDoc;
use Box\TestScribe\PHPDoc\PHPDocMixedType;
use Box\TestScribe\PHPDoc\PHPDocTypeException;
use Box\TestScribe\PHPDoc\PHPDocVoidType;

/**
 * Represent a method
 */
class Method
{
    /**
     * @var PhpClass
     */
    private $inClass;

    /**
     * @var \ReflectionMethod
     */
    private $reflectionMethod;

    /**
     * @var PHPDoc\Annotations[]
     */
    private $methodAnnotations;

    /**
     * Annotations representing parameters. Subset of $methodAnnotations
     *
     * @var PHPDoc\Annotations[]
     */
    private $params;

    /**
     * @var PHPDoc\PHPDocType
     */
    private $returnType;

    /**
     * Name of the method
     *
     * @var string
     */
    private $name;

    /**
     * @param PhpClass          $class
     * @param \ReflectionMethod $method
     */
    public function __construct(PhpClass $class, \ReflectionMethod $method)
    {
        $this->inClass = $class;
        $this->reflectionMethod = $method;
        $this->name = $method->getName();
        $this->initParameterInformation();
    }

    /**
     * Return the class associated with the method
     *
     * @return \Box\TestScribe\ClassInfo\PhpClass
     */
    public function getClass()
    {
        return $this->inClass;
    }

    /**
     * Return the constructor associated with the method.
     *
     * @return \Box\TestScribe\Method|null
     */
    public function getConstructor()
    {
        $methodHelperObj = new MethodHelper();
        $constructorMethodObj = $methodHelperObj->createConstructor($this->inClass);

        return $constructorMethodObj;
    }

    /**
     * Return the full class name associated with the method
     *
     * @return \Box\TestScribe\ClassInfo\PhpClass
     */
    public function getFullClassName()
    {
        $classObj = $this->inClass;
        $fullName = $classObj->getPhpClassName()->getFullyQualifiedClassName();

        return $fullName;
    }

    /**
     * Parse the phpDoc of the method under test
     * and save the parsed doc node object to a
     * member variable.
     *
     * @return void
     */
    private function initParameterInformation()
    {
        $this->loadMethodAnnotations();
        $this->params = $this->filterParams();
        $paramArray = $this->reflectionMethod->getParameters();
        // @TODO (ryang 8/12/14) : more validation of parameters to make sure the phpdoc matches the code.
        $count = count($this->params);
        if ($count !== count($paramArray)) {
            $msg = sprintf(
                "Number of parameters in PHPDoc for Method name ( %s ) doesn't match the code.",
                $this->reflectionMethod->getName()
            );
            App::writeln($msg);
        }
        $isConstructor = $this->reflectionMethod->isConstructor();
        if ($isConstructor) {
            $this->returnType = new PHPDocVoidType();
        } else {
            $returnTypeAnnotation = $this->filterReturnType();

            if ($returnTypeAnnotation) {
                $docString = $returnTypeAnnotation->value();
                $this->returnType = $this->parsePHPDocString($docString, 'return value');
            } else {
                $warningMsg = sprintf(
                    "Method ( %s ) of the class ( %s ) "
                    . "doesn't have the return type specified in its PHPDoc."
                    . "\nAssume mixed return type.",
                    $this->getName(),
                    $this->inClass->getPhpClassName()->getFullyQualifiedClassName()
                );
                App::writeln($warningMsg);
                $this->returnType = new PHPDocMixedType();
            }
        }
    }

    /**
     * Get the reflection method instance associated with the method under test.
     *
     * @return \ReflectionMethod
     */
    public function getReflectionMethod()
    {
        return $this->reflectionMethod;
    }

    /**
     * @return \Box\TestScribe\Parameter[]
     */
    public function getParameters()
    {
        $paramArray = [];
        $parameters = $this->reflectionMethod->getParameters();
        foreach ( $parameters as $reflectionParam) {
            $param = new Parameter($reflectionParam);
            $paramArray[] = $param;
        }

        return $paramArray;
    }

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isStatic()
    {
        $reflectionMethodObj = $this->reflectionMethod;
        $isStatic = $reflectionMethodObj->isStatic();

        return $isStatic;
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        $reflectionMethodObj = $this->reflectionMethod;
        $isPublic = $reflectionMethodObj->isPublic();

        return $isPublic;
    }

    /**
     * Get information about the parameter with the given name.
     *
     * @param string $name
     *      The name should not be prefixed with additional '$'.
     *
     * @return PHPDoc\PHPDocType
     */
    private function getParamInfo(
        $name
    )
    {
        foreach ($this->params as $param) {
            $annotationString = $param->getParamName();
            if ("\$$name" === $annotationString) {
                $PHPDocString = $param->value();
                $typeInfo = $this->parsePHPDocString(
                    $PHPDocString,
                    "parameter ( $name )"
                );

                return $typeInfo;
            }
        }

        $warningMsg = "Can't find PHPDoc type information for the parameter ( $name ). Assume mixed type.";
        App::writeln($warningMsg);

        return new PHPDocMixedType();
    }

    /**
     * @param string $docString PHPDocString for a parameter or the return value
     * @param string $subject description of what the type is for
     *
     * @return \Box\TestScribe\PHPDoc\PHPDocType
     */
    private function parsePHPDocString(
        $docString,
        $subject
    )
    {
        try {
            $typeInfo = PHPDoc\PHPDocType::lookup($docString);
        } catch (PHPDocTypeException $e) {
            $detailedExceptionMsg = $e->getMessage();
            $invalidTypeWarningMsg =
                "Failed to parse PHPDoc type string ( $docString ) for the $subject.\n" .
                "Detailed exception message ( $detailedExceptionMsg )\n" .
                "Assume mixed type.";
            App::writeln($invalidTypeWarningMsg);
            $typeInfo = new PHPDocMixedType();
        }

        return $typeInfo;
    }

    /**
     * Get the type string for the given parameter name.
     *
     * @param $name
     *
     * @return \Box\TestScribe\PHPDoc\PHPDocType
     */
    public function getParamTypeString(
        $name
    )
    {
        // @TODO (ryang 5/31/14) : handle parameters with multiple types and array type.
        $argumentService = new MethodArgumentService();
        // @TODO (ryang 12/5/14) : optimization: scan all parameters in one pass.
        // Check if the parameter is a class and has type information using type hinting
        $paramClassName = $argumentService->getFullyQualifiedClassNameIfAvailable(
            $this->reflectionMethod,
            $name
        );
        if ($paramClassName) {
            $type = PHPDoc\PHPDocType::lookup($paramClassName);
        } else {
            // Fall back to PHPDoc
            $type = $this->getParamInfo($name);
        }

        return $type;
    }

    /**
     * @return \Box\TestScribe\PHPDoc\PHPDocType
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * @return void
     */
    private function loadMethodAnnotations()
    {
        $this->methodAnnotations = $this->getMethodAnnotations($this->name);
    }

    /**
     * Returns Annotation_Annotation objects for each annotation on the Reflection object
     *
     * @param  \ReflectionMethod $reflector
     *
     * @return PHPDoc\Annotations[]
     */
    private function docCommentToAnnotations(
        \ReflectionMethod $reflector
    )
    {
        $comment = $reflector->getDocComment();
        $matches = [];
        preg_match_all('/@([a-zA-Z\_\-]+)[ \t]*(.*)/', $comment, $matches);
        $annotations = [];
        for ($i = 0; $i < count($matches[0]); $i++) {
            $values = [];
            preg_match(
                '/\s*([a-zA-Z\_\\][a-zA-Z\\\|\d\_\[\]\?]*)\s*(\$[a-zA-Z\_][a-zA-Z\_\d]*)?.*/',
                $matches[2][$i],
                $values
            );
            $annotation = new PHPDoc\Annotations($matches[1][$i], $values[1]);
            if (array_key_exists(2, $values)) {
                $annotation->setParamName($values[2]);
            }
            $annotations[] = $annotation;
        }

        return $annotations;
    }

    /**
     * @param string $methodName the name of the method to read
     *
     * @return PHPDoc\Annotations[]
     */
    private function getMethodAnnotations(
        $methodName
    )
    {
        return $this->docCommentToAnnotations(
            new \ReflectionMethod($this->inClass->getPhpClassName()->getFullyQualifiedClassName(), $methodName)
        );
    }

    /**
     * Gets the params from $this->methodAnnotations
     *
     * @return PHPDoc\Annotations[]
     */
    private function filterParams()
    {
        $params = [];
        foreach ($this->methodAnnotations as $annotations) {
            if ($annotations->name() === 'param') {
                $params[] = $annotations;
            }
        }

        return $params;
    }

    /**
     * @return PHPDoc\Annotations|null
     */
    private function filterReturnType()
    {
        foreach ($this->methodAnnotations as $annotations) {
            if ($annotations->name() === 'return') {
                return $annotations;
            }
        }

        return null;
    }

    /**
     * Return true if this tool can generate tests for the method.
     *
     * @return bool
     */
    public function isTestable()
    {
        $method = $this->reflectionMethod;
        if ($method->isAbstract() ||
            $method->isConstructor()
        ) {
            return false;
        }

        return true;
    }
}
