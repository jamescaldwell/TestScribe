<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\ArgumentInfo\Arguments;
use Box\TestScribe\Input\InputValueGetter;
use Box\TestScribe\MethodInfo\Method;

/**
 * Collect arguments to a method.
 */
class ArgumentsCollector
{
    /**
     * @var Output
     */
    private $out;

    /**
     * @var InputValueGetter
     */
    private $inputValueGetterService;

    /**
     * @param \Box\TestScribe\Output           $out
     * @param \Box\TestScribe\Input\InputValueGetter $inputValueGetterService
     */
    function __construct(
        Output $out,
        InputValueGetter $inputValueGetterService
    )
    {
        $this->out = $out;
        $this->inputValueGetterService = $inputValueGetterService;
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
        $this->out->writeln($message);

        $argsArray = [];
        foreach ($args as $arg) {
            $argumentName = $arg->getName();
            $argPromptSubject = "parameter ( $argumentName )";
            $isOptional = $arg->isOptional();
            if ($isOptional) {
                $argPromptSubject = "optional $argPromptSubject";
            }
            $typeInfo = $method->getParamTypeString($argumentName);
            $inputValue = $this->inputValueGetterService->get(
                $typeInfo,
                $argPromptSubject,
                '',
                $methodName,
                $argumentName
            );
            if ($inputValue->isVoid()) {
                // @TODO (ryang 1/9/15) : double check if the parameter is optional.
                // Assume the parameters after this one will all have to be void.
                break;
            }
            $argsArray[] = $inputValue;
        }

        // Add an empty line for improved readability.
        $this->out->writeln('');

        $args = new Arguments($argsArray);

        return $args;
    }
}
