<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\MockClass;
use Box\TestScribe\Utils\ArrayUtil;

/**
 * Generate mock statements for a group of injected mock objects.
 *
 * @var OneInjectedMockRenderer
 */
class MultipleInjectedMocksRenderer
{
    /** @var OneInjectedMockRenderer */
    private $oneInjectedMockRenderer;

    function __construct(
        OneInjectedMockRenderer $oneInjectedMockRenderer
    )
    {
        $this->oneInjectedMockRenderer = $oneInjectedMockRenderer;
    }

    /**
     * Generate all injection statements for either mock classes or mock objects.
     *
     * @param array  $mocks
     *   class name string => MockClass
     * @param string $injectMethodName
     *
     * @return string
     */
    public function genInjectionStatements($mocks, $injectMethodName)
    {
        $statementArray = [];
        /* @var $mock MockClass */
        foreach ($mocks as $mock) {
            $statement = $this->oneInjectedMockRenderer->genInjectedMockStatement(
                $mock,
                $injectMethodName
            );
            $statementArray[]= $statement;
        }
        $combinedStatements = ArrayUtil::joinNonEmptyStringsWithNewLine(
            $statementArray,
            2
        );
        return $combinedStatements;
    }
}
