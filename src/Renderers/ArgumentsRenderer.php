<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Arguments;
use Box\TestScribe\Utils\ArrayUtil;

/**
 * Class ArgumentsRenderer
 * @package Box\TestScribe
 *
 * Generate test code for the arguments.
 */
class ArgumentsRenderer
{
    /**
     * @var MockRenderer
     */
    private $mockRenderer;

    /**
     * @param \Box\TestScribe\Renderers\MockRenderer $mockRenderer
     */
    function __construct(
        MockRenderer $mockRenderer
    )
    {
        $this->mockRenderer = $mockRenderer;
    }

    /**
     * Generate the argument list as a string and
     * its referenced mock statements.
     *
     * @param \Box\TestScribe\Arguments $argsObj
     *
     * @return \Box\TestScribe\Renderers\ArgumentsRenderResult
     */
    public function renderArguments(Arguments $argsObj)
    {
        $expressions = $argsObj->getExpressions();
        $argumentsString = implode(', ', $expressions);

        $mocks = $argsObj->getMocks();

        $mockObjectStatementArray = [];
        foreach ($mocks as $mock) {
            $mockObjectStatement = $this->mockRenderer->renderAMock($mock);
            $mockObjectStatementArray[] = $mockObjectStatement;
        }
        $mockObjectStatementsString = ArrayUtil::joinNonEmptyStringsWithNewLine(
            $mockObjectStatementArray,
            2
        );

        $result = new ArgumentsRenderResult($argumentsString, $mockObjectStatementsString);

        return $result;
    }

    /**
     * Generate the argument list string to be used in the method invocation statement.
     *
     * @param \Box\TestScribe\Arguments $argsObj
     *
     * @return string
     */
    public function renderArgumentsAsStringInCode(
        Arguments $argsObj
    )
    {
        $expressions = $argsObj->getExpressions();
        $argumentsString = implode(', ', $expressions);

        return $argumentsString;
    }
}
