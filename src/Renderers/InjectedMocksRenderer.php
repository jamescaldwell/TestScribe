<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\Utils\ArrayUtil;
use Box\TestScribe\Utils\Util;

/**
 * Class InjectedMocksRenderer
 * @package Box\TestScribe\Renderers
 *
 * Generate mock statements for the injected mock objects
 *
 * @var InjectedMockObjectsRenderer|InjectedMockClassesRenderer
 */
class InjectedMocksRenderer
{
    /** @var InjectedMockObjectsRenderer */
    private $injectedMockObjectsRenderer;

    /** @var InjectedMockClassesRenderer */
    private $injectedMockClassesRenderer;

    /**
     * @param \Box\TestScribe\Renderers\InjectedMockObjectsRenderer $injectedMockObjectsRenderer
     * @param \Box\TestScribe\Renderers\InjectedMockClassesRenderer $injectedMockClassesRenderer
     */
    function __construct(
        InjectedMockObjectsRenderer $injectedMockObjectsRenderer,
        InjectedMockClassesRenderer $injectedMockClassesRenderer
    )
    {
        $this->injectedMockObjectsRenderer = $injectedMockObjectsRenderer;
        $this->injectedMockClassesRenderer = $injectedMockClassesRenderer;
    }

    /**
     * Generate statements for setting up the mocks of the objects
     * injected by the dependency management system.
     *
     * @return string
     */
    public function renderObjectInjectionStatements()
    {
        $objectInjectionStatements =
            $this->injectedMockObjectsRenderer->genMockedObjectStatements();
        $mockClassInjectionStatements =
            $this->injectedMockClassesRenderer->genMockedClassesStatements();

        $combinedStatements = ArrayUtil::joinNonEmptyStringsWithNewLine(
            [$objectInjectionStatements,$mockClassInjectionStatements],
            2
        );

        $comment = "// Setup mocks injected by the dependency management system.\n\n";
        $result = Util::appendStringIfNotEmpty(
            $comment,
            $combinedStatements
        );

        return $result;
    }
}
