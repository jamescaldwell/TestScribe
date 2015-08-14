<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Mock\MockClass;
use Box\TestScribe\Utils\ArrayUtil;

/**
 * Generate all mocked object expectations.
 */
class MockAllMethodExpectationsRenderer
{
    /**
     * @var MockMethodExpectationRenderer
     */
    private $mockMethodExpectationRenderer;

    /**
     * @param \Box\TestScribe\Renderers\MockMethodExpectationRenderer $mockMethodExpectationRenderer
     */
    function __construct(
        MockMethodExpectationRenderer $mockMethodExpectationRenderer
    )
    {
        $this->mockMethodExpectationRenderer = $mockMethodExpectationRenderer;
    }

    /**
     * Return the statements that sets the expectations and
     * return values of the method invocation of the mocked
     * object.
     *
     * @param MockClass $mock
     *
     * @return string
     */
    public function renderMethodExpectations(
        MockClass $mock
    )
    {
        $mockedExpectationsArray = [];
        foreach ($mock->getMethodInvocations()
                 as $invocation) {
            list($methodObj, $arguments, $value) = $invocation;
            $mockedOneExpectation = $this->mockMethodExpectationRenderer->renderOneMethodExpectation(
                $methodObj,
                $arguments,
                $value
            );
            $mockedExpectationsArray[] = $mockedOneExpectation;
        }

        $mockedExpectations = ArrayUtil::joinNonEmptyStringsWithNewLine(
            $mockedExpectationsArray,
            2
        );
        return $mockedExpectations;
    }
}
