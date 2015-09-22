<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Execution\ExecutionResult;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Mock\PartialMockUtil;
use Box\TestScribe\Utils\ArrayUtil;

/**
 * Render method invocation statements.
 *
 * Class InvocationRenderer
 * @package Box\TestScribe\Renderers
 *
 * @var GlobalComputedConfig|MockRenderer|ArgumentsRenderer|ExecutionAndVerificationRenderer|PartialMockUtil
 */
class InvocationRenderer
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var MockRenderer */
    private $mockRenderer;

    /** @var ArgumentsRenderer */
    private $argumentsRenderer;

    /** @var ExecutionAndVerificationRenderer */
    private $executionAndVerificationRenderer;

    /** @var PartialMockUtil */
    private $partialMockUtil;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\Renderers\MockRenderer $mockRenderer
     * @param \Box\TestScribe\Renderers\ArgumentsRenderer $argumentsRenderer
     * @param \Box\TestScribe\Renderers\ExecutionAndVerificationRenderer $executionAndVerificationRenderer
     * @param \Box\TestScribe\Mock\PartialMockUtil $partialMockUtil
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        MockRenderer $mockRenderer,
        ArgumentsRenderer $argumentsRenderer,
        ExecutionAndVerificationRenderer $executionAndVerificationRenderer,
        PartialMockUtil $partialMockUtil
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->mockRenderer = $mockRenderer;
        $this->argumentsRenderer = $argumentsRenderer;
        $this->executionAndVerificationRenderer = $executionAndVerificationRenderer;
        $this->partialMockUtil = $partialMockUtil;
    }


    /**
     * Return statements for invoking the test and verifying the result.
     *
     * @param \Box\TestScribe\Execution\ExecutionResult $executionResult
     *
     * @return string
     */
    public function renderMethodInvocation(
        ExecutionResult $executionResult
    )
    {
        $mockClassUnderTest = $executionResult->getMockClassUnderTest();
        $config = $this->globalComputedConfig;
        $inMethod = $config->getInMethod();
        $reflectionMethod = $inMethod->getReflectionMethod();
        $isStatic = $reflectionMethod->isStatic();
        $fullyQualifiedClassName = $config->getFullClassName();

        $constructorArguments = $executionResult->getConstructorArguments();
        $constructorArgumentsRenderedResult =
            $this->argumentsRenderer->renderArguments($constructorArguments);
        $constructorArgumentsString = $constructorArgumentsRenderedResult->getArgumentString();
        $mockObjectForConstructorStatements = $constructorArgumentsRenderedResult->getMockStatements();
        if ($mockObjectForConstructorStatements) {
            $mockObjectForConstructorStatements =
                "// Setup mocks for parameters to the constructor.\n\n"
                . $mockObjectForConstructorStatements;
        }

        $methodArguments = $executionResult->getMethodArguments();
        $argumentsToTheMethodRenderedResult =
            $this->argumentsRenderer->renderArguments($methodArguments);
        $mockMethodArgumentsStatements = $argumentsToTheMethodRenderedResult->getMockStatements();
        if ($mockMethodArgumentsStatements) {
            $mockMethodArgumentsStatements =
                "// Setup mocks for parameters to the method under test.\n\n"
                . $mockMethodArgumentsStatements;
        }

        $mockAndComment = ArrayUtil::joinNonEmptyStringsWithNewLine(
            [
                "$mockMethodArgumentsStatements",
                "// Execute the method under test."
            ],
            2
        );

        $isPartialMocking = $this->partialMockUtil->isClassUnderTestPartiallyMocked(
            $mockClassUnderTest
        );

        $createObjectWithMocksStatement = '';
        $targetObjectName = '';
        if (!$isStatic) {
            if ($isPartialMocking) {
                // @TODO (ryang 3/4/15) : move the generated mock statements for the constructor into this scope.
                $createObjectWithMocksStatement = $this->mockRenderer->renderPartialMock(
                    $mockClassUnderTest,
                    $constructorArgumentsString,
                    $mockObjectForConstructorStatements
                );
                $targetObjectName = $mockClassUnderTest->getMockObjectName();
            } else {
                $targetObjectName = 'objectUnderTest';
                $createObjectStatement =
                    "\$$targetObjectName = new $fullyQualifiedClassName($constructorArgumentsString);";

                $createObjectWithMocksStatement =
                    ArrayUtil::joinNonEmptyStringsWithNewLine(
                        [$mockObjectForConstructorStatements, $createObjectStatement],
                        2
                    );
            }
        }

        $invocationStatement =
            $this->executionAndVerificationRenderer->genExecutionAndVerification(
                $executionResult,
                $targetObjectName
            );

        $result = ArrayUtil::joinNonEmptyStringsWithNewLine(
            [$mockAndComment, $createObjectWithMocksStatement, $invocationStatement],
            2
        );

        return $result;
    }

}
