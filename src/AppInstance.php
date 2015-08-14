<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Mock\InjectedMockClassMgr;
use Box\TestScribe\Mock\InjectedMockMgr;

/**
 * Global singleton app instance
 * Delay instantiation of this class until it is actually needed.
 * This is necessary because it indirectly depends on the 
 * output to be initialized.
 * 
 * @Injectable(lazy=true)
 *
 * Class AppInstance
 * @package Box\TestScribe
 */
class AppInstance
{
    /**
     * @var InjectedMockMgr
     */
    private $injectedMockMgr;

    /**
     * @var InjectedMockClassMgr;
     */
    private $injectedMockClassMgr;

    /**
     * @param \Box\TestScribe\Mock\InjectedMockMgr      $injectedMockMgr
     * @param \Box\TestScribe\Mock\InjectedMockClassMgr $injectedMockClassMgr
     */
    function __construct(
        InjectedMockMgr $injectedMockMgr,
        InjectedMockClassMgr $injectedMockClassMgr
    )
    {
        $this->injectedMockMgr = $injectedMockMgr;
        $this->injectedMockClassMgr = $injectedMockClassMgr;
    }

    /**
     * @return InjectedMockMgr
     */
    public function getInjectedMockMgr()
    {
        return $this->injectedMockMgr;
    }

    /**
     * @return InjectedMockClassMgr
     */
    public function getInjectedMockClassMgr()
    {
        return $this->injectedMockClassMgr;
    }
}
