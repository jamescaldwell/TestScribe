<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Input\InputValue;
use Box\TestScribe\Method;

/**
 * Class MockMethodExpectationRenderer
 * @package Box\TestScribe\Renderers
 *
 * Generate one mocked object expecation.
 */
class MockMethodExpectationRenderer
{
    /**
     * @var MockedMethodInvocationArgumentsRenderer
     */
    private $mockedMethodInvocationArgumentsRenderer;

    /**
     * @param \Box\TestScribe\Renderers\MockedMethodInvocationArgumentsRenderer $mockedMethodInvocationArgumentsRenderer
     */
    function __construct(
        MockedMethodInvocationArgumentsRenderer $mockedMethodInvocationArgumentsRenderer
    )
    {
        $this->mockedMethodInvocationArgumentsRenderer = $mockedMethodInvocationArgumentsRenderer;
    }

    /**
     * Generate and return the statement for setting up one
     * mocked object method invocation expectation.
     *
     * @param Method     $methodObj
     * @param array      $arguments
     * @param InputValue $returnValue
     *
     * @return string
     */
    public function renderOneMethodExpectation(
        Method $methodObj,
        array $arguments,
        InputValue $returnValue
    )
    {
        $methodName = $methodObj->getName();
        $argString = $this->mockedMethodInvocationArgumentsRenderer
            ->renderMockedMethodArguments($arguments);

        $expectationStatements = "\$shmock->$methodName($argString);";

        // @TODO (ryang 9/12/14) : can we make this decision purely based on the $value?
        // If no return value still specify return null?

        // If the method has no return value
        // don't generate the return value mock statement.
        if (!$returnValue->isVoid()) {
            $returnValueAsString = $returnValue->getExpression();
            $returnValueCallStatement =
                "\$mock->return_value($returnValueAsString);";

            $expectationStatements =
                "/** @var \$mock \Shmock\Spec */\n" .
                "\$mock = $expectationStatements\n" .
                "$returnValueCallStatement";
        }

        return $expectationStatements;
    }
}
