<?php
namespace Box\TestScribe\Execution;

use Box\TestScribe\Arguments;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Exception\AbortException;
use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Mock\MockClassLoader;
use Box\TestScribe\Utils\ExceptionUtil;

/**
 * Execute the method under test.
 *
 * @var  MockClassLoader | GlobalComputedConfig|StaticMethodExecutor|InstanceMethodExecutor
 */
class Executor
{

    /** @var MockClassLoader */
    private $mockClassLoader;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var StaticMethodExecutor */
    private $staticMethodExecutor;

    /** @var InstanceMethodExecutor */
    private $instanceMethodExecutor;

    /**
     * @param \Box\TestScribe\Mock\MockClassLoader        $mockClassLoader
     * @param \Box\TestScribe\Config\GlobalComputedConfig   $globalComputedConfig
     * @param \Box\TestScribe\Execution\StaticMethodExecutor   $staticMethodExecutor
     * @param \Box\TestScribe\Execution\InstanceMethodExecutor $instanceMethodExecutor
     */
    function __construct(
        MockClassLoader $mockClassLoader,
        GlobalComputedConfig $globalComputedConfig,
        StaticMethodExecutor $staticMethodExecutor,
        InstanceMethodExecutor $instanceMethodExecutor
    )
    {
        $this->mockClassLoader = $mockClassLoader;
        $this->globalComputedConfig = $globalComputedConfig;
        $this->staticMethodExecutor = $staticMethodExecutor;
        $this->instanceMethodExecutor = $instanceMethodExecutor;
    }

    /**
     * @return \Box\TestScribe\Execution\ExecutionResult
     * @throws \Box\TestScribe\Exception\AbortException
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function runMethod()
    {
        $config = $this->globalComputedConfig;
        $methodName = $config->getMethodName();
        $isStatic = $config->isMethodStatic();

        if ($isStatic) {
            // Partial mocking of static methods is not supported.
            $mockClassUnderTest = null;
        } else {
            // Even when the real constructor throws an exception,
            // the mocked object of the class under test is still needed
            // to generate the mock statements to cause the exception
            // to happen.
            // It's also beneficial to have the exception logic in one place.
            // That's why this logic and exception logic are here instead of
            // inside the InstanceMethodExecutor class.
            $className = $config->getFullClassName();
            $mockClassUnderTest = $this->mockClassLoader->createAndLoadMockClass(
                $className,
                $methodName
            );
        }

        // Initialize the local variables explicitly
        // so that they have valid values in case of an exception.
        $returnValue = null;
        $exceptionFromExecution = null;
        $constructorArgs = new Arguments([]);
        $methodArgs = new Arguments([]);

        try {
            if ($isStatic) {
                // Note partial mocking of static methods is not supported.
                $staticExecutionResult = $this->staticMethodExecutor->runStaticMethod();

                $returnValue = $staticExecutionResult->getValue();
                $methodArgs = $staticExecutionResult->getArguments();
            } else {
                $methodObj = $config->getInMethod();
                $instanceExecutionResult = $this->instanceMethodExecutor->runInstanceMethod(
                    $mockClassUnderTest,
                    $methodObj
                );
                $returnValue = $instanceExecutionResult->getValue();
                $methodArgs = $instanceExecutionResult->getMethodArguments();
                $constructorArgs = $instanceExecutionResult->getConstructorArguments();
            }
        } catch (AbortException $abortException) {
            throw $abortException;
        } catch (TestScribeException $generatorException) {
            // @TODO (ryang 6/4/15) : Do not rethrow TestScribeException
            // when the test run is against the tool itself.
            // Chain the original exception to provide details on the original exception.
            ExceptionUtil::rethrowSameException($generatorException);
        } catch (\Exception $exception) {
            $exceptionFromExecution = $exception;
        }

        $result = new ExecutionResult(
            $constructorArgs,
            $methodArgs,
            $mockClassUnderTest,
            $returnValue,
            $exceptionFromExecution
        );

        return $result;
    }
}
