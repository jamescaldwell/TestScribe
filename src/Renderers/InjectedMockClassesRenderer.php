<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Mock\InjectedMockClassMgr;

/**
 * Generate mock statements for the injected mocked objects.
 *
 * @var MultipleInjectedMocksRenderer|InjectedMockClassMgr|GlobalComputedConfig
 */
class InjectedMockClassesRenderer
{
    /** @var MultipleInjectedMocksRenderer */
    private $multipleInjectedMocksRenderer;

    /** @var InjectedMockClassMgr */
    private $injectedMockClassMgr;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /**
     * @param \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer $multipleInjectedMocksRenderer
     * @param \Box\TestScribe\Mock\InjectedMockClassMgr                    $injectedMockClassMgr
     * @param \Box\TestScribe\Config\GlobalComputedConfig                    $globalComputedConfig
     */
    function __construct(
        MultipleInjectedMocksRenderer $multipleInjectedMocksRenderer,
        InjectedMockClassMgr $injectedMockClassMgr,
        GlobalComputedConfig $globalComputedConfig
    )
    {
        $this->multipleInjectedMocksRenderer = $multipleInjectedMocksRenderer;
        $this->injectedMockClassMgr = $injectedMockClassMgr;
        $this->globalComputedConfig = $globalComputedConfig;
    }


    /**
     * Generate statements for setting up the mocks of the classes
     * injected by the dependency management system.
     * Static methods are expected to be invoked on these mocks.
     *
     * @return string
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function genMockedClassesStatements()
    {
        $mocks = $this->injectedMockClassMgr->getInjectedMockedClass();
        if (empty($mocks)) {
            return '';
        }

        $injectMockedClassMethodName =
            $this->globalComputedConfig->getInjectMockedClassMethodName();
        if (!$injectMockedClassMethodName) {
            throw new TestScribeException(
                'Method name to generate statements for setting up mocked classes is not set.'
            );
        }

        $statements = $this->multipleInjectedMocksRenderer->genInjectionStatements(
            $mocks,
            $injectMockedClassMethodName
        );

        return $statements;
    }
}
