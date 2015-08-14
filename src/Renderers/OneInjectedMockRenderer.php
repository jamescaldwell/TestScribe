<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\Mock\MockClass;
use Box\TestScribe\Utils\ArrayUtil;

/**
 * Generate mock statements for one injected mock object.
 *
 * @var MockRenderer
 */
class OneInjectedMockRenderer
{
    /** @var MockRenderer */
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
     * @param \Box\TestScribe\Mock\MockClass $mockClass
     * @param string                              $injectMethodName
     *
     * @return string
     */
    public function genInjectedMockStatement(
        MockClass $mockClass,
        $injectMethodName
    )
    {
        $createMockObjectStatement = $this->mockRenderer->renderAMock($mockClass);
        $injectStatement = $this->genInjectionStatement(
            $mockClass,
            $injectMethodName
        );
        // @TODO (ryang 8/6/14) : better handling of indentations.
        $combinedStatements = ArrayUtil::joinNonEmptyStringsWithNewLine(
            [$createMockObjectStatement, $injectStatement],
            1
        );

        return $combinedStatements;
    }

    /**
     * @param \Box\TestScribe\Mock\MockClass $mockClass
     * @param string                              $injectMockedObjectMethodName
     *
     * @return string
     */
    private function genInjectionStatement(
        MockClass $mockClass,
        $injectMockedObjectMethodName
    )
    {
        $className = $mockClass->getClassNameBeingMocked();
        $mockObjectName = $mockClass->getMockObjectName();

        // The $mockVariableName value doesn't include '$'
        // add '$' in the front to make it a valid statement.
        $statement = sprintf(
            "%s('%s', $%s);",
            $injectMockedObjectMethodName,
            $className,
            $mockObjectName
        );

        return $statement;
    }
}
