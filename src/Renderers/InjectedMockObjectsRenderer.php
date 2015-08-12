<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\GeneratorException;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\InjectedMockMgr;

/**
 * Generate mock statements for the injected mocked objects.
 *
 * @var MultipleInjectedMocksRenderer|InjectedMockMgr|\Box\TestScribe\Config\GlobalComputedConfig
 */
class InjectedMockObjectsRenderer
{
    /** @var MultipleInjectedMocksRenderer */
    private $multipleInjectedMocksRenderer;

    /** @var InjectedMockMgr */
    private $injectedMockMgr;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /**
     * @param \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer $multipleInjectedMocksRenderer
     * @param \Box\TestScribe\InjectedMockMgr                         $injectedMockMgr
     * @param \Box\TestScribe\Config\GlobalComputedConfig                    $globalComputedConfig
     */
    function __construct(
        MultipleInjectedMocksRenderer $multipleInjectedMocksRenderer,
        InjectedMockMgr $injectedMockMgr,
        GlobalComputedConfig $globalComputedConfig
    )
    {
        $this->multipleInjectedMocksRenderer = $multipleInjectedMocksRenderer;
        $this->injectedMockMgr = $injectedMockMgr;
        $this->globalComputedConfig = $globalComputedConfig;
    }

    /**
     * Generate statements for setting up the mocks of the objects
     * injected by the dependency management system.
     * Instance methods are expected to be invoked on these mocks.
     *
     * @return string
     * @throws \Box\TestScribe\GeneratorException
     */
    public function genMockedObjectStatements()
    {
        $mocks = $this->injectedMockMgr->getInjectedMockedObjects();
        if (empty($mocks)) {
            return '';
        }

        $injectMockedObjectMethodName =
            $this->globalComputedConfig->getInjectMockedObjectMethodName();
        if (!$injectMockedObjectMethodName) {
            throw new GeneratorException(
                'Method name to generate statements for setting up mocked objects is not set.'
            );
        }

        $statements = $this->multipleInjectedMocksRenderer->genInjectionStatements(
            $mocks,
            $injectMockedObjectMethodName
        );

        return $statements;
    }
}
