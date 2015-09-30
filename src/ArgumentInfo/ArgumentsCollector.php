<?php
/**
 *
 */

namespace Box\TestScribe\ArgumentInfo;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Input\InputValueFactory;
use Box\TestScribe\Input\InputValueGetter;
use Box\TestScribe\MethodInfo\Method;
use Box\TestScribe\Output;
use Box\TestScribe\Spec\SavedSpecs;

/**
 * Collect arguments to a method.
 * @var Output|InputValueGetter|SavedSpecs|GlobalComputedConfig|InputValueFactory
 */
class ArgumentsCollector
{
    /** @var Output */
    private $output;

    /** @var InputValueGetter */
    private $inputValueGetter;

    /** @var SavedSpecs */
    private $savedSpecs;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var InputValueFactory */
    private $inputValueFactory;

    /**
     * @param \Box\TestScribe\Output $output
     * @param \Box\TestScribe\Input\InputValueGetter $inputValueGetter
     * @param \Box\TestScribe\Spec\SavedSpecs $savedSpecs
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\Input\InputValueFactory $inputValueFactory
     */
    function __construct(
        Output $output,
        InputValueGetter $inputValueGetter,
        SavedSpecs $savedSpecs,
        GlobalComputedConfig $globalComputedConfig,
        InputValueFactory $inputValueFactory
    )
    {
        $this->output = $output;
        $this->inputValueGetter = $inputValueGetter;
        $this->savedSpecs = $savedSpecs;
        $this->globalComputedConfig = $globalComputedConfig;
        $this->inputValueFactory = $inputValueFactory;
    }

    /**
     * Collect values of the arguments to the given method.
     *
     * @param \Box\TestScribe\MethodInfo\Method $method
     *
     * @return \Box\TestScribe\ArgumentInfo\Arguments
     */
    public function collect(Method $method)
    {
        $reflectionMethod = $method->getReflectionMethod();
        $args = $reflectionMethod->getParameters();
        $argumentsCount = count($args);
        if (!$argumentsCount) {

            return new Arguments([]);
        }

        $methodName = $reflectionMethod->getName();
        $className = $reflectionMethod->getDeclaringClass()->getName();
        $message =
            "\nPrepare to get arguments to the method ( $methodName ) of the class ( $className ).\n";
        $this->output->writeln($message);

        $methodParams = null;
        if (!$method->isConstructor()) {
            $testName = $this->globalComputedConfig->getTestMethodName();
            $savedSpec = $this->savedSpecs->getSpecForTest($testName);
            if ($savedSpec) {
                $methodParams = $savedSpec->getMethodParameters();
            }
        }

        $argsArray = [];
        $index = 0;
        foreach ($args as $arg) {
            $argumentName = $arg->getName();
            $argPromptSubject = "parameter ( $argumentName )";
            $isOptional = $arg->isOptional();
            if ($isOptional) {
                $argPromptSubject = "optional $argPromptSubject";
            }

            if ($methodParams){
                $value = $methodParams[$index];
                $this->output->writeln("Get ( $value ) from the saved test for $argPromptSubject");
                $inputValue = $this->inputValueFactory->createPrimitiveValue($value);
            } else {
                $typeInfo = $method->getParamTypeString($argumentName);
                $inputValue = $this->inputValueGetter->get(
                    $typeInfo,
                    $argPromptSubject,
                    '',
                    $methodName,
                    $argumentName
                );
            }
            if ($inputValue->isVoid()) {
                // @TODO (ryang 1/9/15) : double check if the parameter is optional.
                // Assume the parameters after this one will all have to be void.
                break;
            }
            $argsArray[] = $inputValue;
            $index++;
        }

        // Add an empty line for improved readability.
        $this->output->writeln('');

        $args = new Arguments($argsArray);

        return $args;
    }
}
