<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\Execution\ExecutionResult;
use Box\TestScribe\Utils\ArrayUtil;

/**
 * Class MethodRenderer
 * @package Box\TestScribe
 *
 * Generate one test method body, the part between { and }.
 *
 * @var InjectedMocksRenderer|InvocationRenderer|ResultValidationRenderer|ExceptionRenderer
 */
class MethodBodyRenderer
{
    /** @var InjectedMocksRenderer */
    private $injectedMocksRenderer;

    /** @var InvocationRenderer */
    private $invocationRenderer;

    /** @var ExceptionRenderer */
    private $exceptionRenderer;

    /**
     * @param \Box\TestScribe\Renderers\InjectedMocksRenderer    $injectedMocksRenderer
     * @param \Box\TestScribe\Renderers\InvocationRenderer       $invocationRenderer
     * @param \Box\TestScribe\Renderers\ExceptionRenderer        $exceptionRenderer
     */
    function __construct(
        InjectedMocksRenderer $injectedMocksRenderer,
        InvocationRenderer $invocationRenderer,
        ExceptionRenderer $exceptionRenderer
    )
    {
        $this->injectedMocksRenderer = $injectedMocksRenderer;
        $this->invocationRenderer = $invocationRenderer;
        $this->exceptionRenderer = $exceptionRenderer;
    }

    /**
     * Generate the test method as a string.
     *
     * @param \Box\TestScribe\Execution\ExecutionResult   $executionResult
     *
     * @return string
     */
    public function renderMethodBody(
        ExecutionResult $executionResult
    )
    {
        $objectInjectionStatements = $this->injectedMocksRenderer->renderObjectInjectionStatements();

        $exceptionExpectationStatements = $this->exceptionRenderer->genExceptionExpectation(
            $executionResult
        );

        $methodInvocationStatements = $this->invocationRenderer->renderMethodInvocation(
            $executionResult
        );

        // @TODO (ryang 6/3/15) : move exception expectation statement after all the mocks statements.
        $methodBody = ArrayUtil::joinNonEmptyStringsWithNewLine(
            [
                $objectInjectionStatements,
                $exceptionExpectationStatements,
                $methodInvocationStatements
            ],
            2
        );


        return $methodBody;
    }
}
