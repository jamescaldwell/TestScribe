<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\Arguments;
use Box\TestScribe\MethodInfo\Method;
use Box\TestScribe\Output;

/**
 * Class ReflectionUtil
 * @package Box\TestScribe\Utils
 *
 * @var Output
 */
class ReflectionUtil
{
    /** @var Output */
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
     * Invoke a method on the target object regardless if the method is private, protected or public.
     *
     * @param object|null                         $targetObject null if the method is static
     * @param \Box\TestScribe\MethodInfo\Method    $method
     * @param \Box\TestScribe\Arguments $arguments
     *
     * @return mixed
     */
    public function invokeMethodRegardlessOfProtectionLevel(
        $targetObject,
        Method $method,
        Arguments $arguments
    )
    {
        $className = $method->getFullClassName();
        $argumentValues = $arguments->getValues();

        // @TODO (ryang 2/3/15) : warn against testing private methods directly.
        // @TODO (ryang 6/8/15) : only change accessibility when the method is not public
        $reflectionClass = new \ReflectionClass($className);
        $methodName = $method->getName();
        $reflectionMethod = $reflectionClass->getMethod($methodName);
        $reflectionMethod->setAccessible(true);

        $this->output->writeln("\nStart executing method ( $methodName ).\n");

        $executionResult = $reflectionMethod->invokeArgs($targetObject, $argumentValues);

        $this->output->writeln("\nFinish executing method ( $methodName ).\n");

        return $executionResult;
    }
}
