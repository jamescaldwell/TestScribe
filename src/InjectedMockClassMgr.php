<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Mock\MockClass;
use Box\TestScribe\Utils\CallOriginatorChecker;

/**
 * Manage injected mock classes for static invocations.
 * e.g. injected via Statics framework.
 *
 * @var Output | StaticMockClassFactory | CallOriginatorChecker
 */
class InjectedMockClassMgr
{
    /**
     * The array of mocked classes being injected via dependency management
     * system. Static methods are going to be invoked on these mocks.
     *
     * @var array
     *   mocked class name string => MockClass
     */
    static private $injectedMockedClass = [];

    /** @var Output */
    private $output;

    /** @var StaticMockClassFactory */
    private $staticMockClassFactory;

    /** @var CallOriginatorChecker */
    private $callOriginatorChecker;

    /**
     * @param \Box\TestScribe\Output                      $output
     * @param \Box\TestScribe\StaticMockClassFactory      $staticMockClassFactory
     * @param \Box\TestScribe\Utils\CallOriginatorChecker $callOriginatorChecker
     */
    function __construct(
        Output $output,
        StaticMockClassFactory $staticMockClassFactory,
        CallOriginatorChecker $callOriginatorChecker
    )
    {
        $this->output = $output;
        $this->staticMockClassFactory = $staticMockClassFactory;
        $this->callOriginatorChecker = $callOriginatorChecker;
    }


    /**
     * The dependency management system used by the method under test should call this method
     * to return a mocked class name when a class mock is requested
     * to be used to invoke a static method.
     *
     * Return null if users decide not to mock this object and have the dependency management
     * system use the real class.
     *
     * @param string $className
     *
     * @return string|null
     */
    public function createMockedClass(
        $className
    )
    {
        // Make sure to update the index if the caller hierarchy changes.

        // #1  Box\TestScribe\InjectedMockClassMgr->createMockInstance()
        // #2  Box\TestScribe\App::createMockedClass()
        // #3  Box\TestScribe\_fixture\StaticServiceLocator::resolveInternal()
        // #4  Box\TestScribe\_fixture\StaticServiceLocator::resolve()
        // #5  Box\TestScribe\_fixture\_input\StaticCalculatorViaLocator->calculateWithACalculator()
        $isTheCallFromTheClassBeingTested = $this->callOriginatorChecker
            ->isCallFromTheClassBeingTested(5);
        if (!$isTheCallFromTheClassBeingTested) {
            return null;
        }

        if (array_key_exists($className, self::$injectedMockedClass)) {
            $this->output->writeln(
                "Requesting class ( $className ) for static method calls which was mocked." .
                " Return the same mock object."
            );
            /**
             * @var MockClass $mock
             */
            $mock = self::$injectedMockedClass[$className];

            return $mock->getMockObjectName();
        }

        $mock = $this->staticMockClassFactory->createAndLoadStaticMockClass($className);

        self::$injectedMockedClass[$className] = $mock;

        return $mock->getMockObjectName();
    }

    /**
     * @return array
     */
    public function getInjectedMockedClass()
    {
        return self::$injectedMockedClass;
    }
}
