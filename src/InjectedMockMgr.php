<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Mock\FullMockObjectFactory;
use Box\TestScribe\Mock\MockClass;
use Box\TestScribe\Utils\CallOriginatorChecker;

/**
 * Manage injected mocks
 * e.g. injected via Diesel
 *
 * Class InjectedMocks
 * @package Box\TestScribe
 *
 * @var Output|FullMockObjectFactory|CallOriginatorChecker
 */
class InjectedMockMgr
{
    /** @var Output */
    private $output;

    /** @var FullMockObjectFactory */
    private $fullMockObjectFactory;

    /** @var CallOriginatorChecker */
    private $callOriginatorChecker;

    /**
     * @param \Box\TestScribe\Output                      $output
     * @param \Box\TestScribe\Mock\FullMockObjectFactory       $fullMockObjectFactory
     * @param \Box\TestScribe\Utils\CallOriginatorChecker $callOriginatorChecker
     */
    function __construct(
        Output $output,
        FullMockObjectFactory $fullMockObjectFactory,
        CallOriginatorChecker $callOriginatorChecker
    )
    {
        $this->output = $output;
        $this->fullMockObjectFactory = $fullMockObjectFactory;
        $this->callOriginatorChecker = $callOriginatorChecker;
    }

    /**
     * The array of mocked objects being injected via dependency management
     * system. Instance methods are expected to be invoked on these objects.
     *
     * It doesn't include mocks of the parameters passed
     * to the method under test.
     *
     * @var array
     *   mocked class name string => MockClass
     */
    private $injectedMockedObjects = [];

    /**
     * Create a mock object of the given class.
     *
     * Return null if users decide not to mock this object.
     *
     * @param       $className
     * @param array $arguments
     *
     * @return null|object
     */
    public function createMockInstance(
        $className,
        /** @noinspection PhpUnusedParameterInspection */
        array $arguments
    )
    {
        // Make sure to update the index if the caller hierarchy changes.
         
        // #1  Box\TestScribe\InjectedMockMgr->createMockInstance()
        // #2  Box\TestScribe\App::createMockedInstance()
        // #3  Box\TestScribe\_fixture\ServiceLocator::resolve_internal()
        // #4  Box\TestScribe\_fixture\ServiceLocator::resolve()
        // #5  Box\TestScribe\_fixture\_input\CalculatorViaLocator->calculateWithACalculator()
        $isTheCallFromTheClassBeingTested = $this->callOriginatorChecker
            ->isCallFromTheClassBeingTested(5);
        if (!$isTheCallFromTheClassBeingTested) {
            return null;
        }
        if (array_key_exists($className, $this->injectedMockedObjects)) {
            
            // @TODO (ryang 1/27/15) : in Box webapp the diesel system will return
            // the same mock object if Diesel::Foo is called multiple times in 
            // the same test and a mock for Foo is registered. 
            // research if this behavior should be assumed for all 
            // service locator systems.
            $msg = "Instantiating class ( $className ) which was mocked."
                . " Return the same mock object.";
            $this->output->writeln($msg);

            /**
             * @var MockClass $mockClass
             */
            $mockClass = $this->injectedMockedObjects[$className];

            return $mockClass->getMockedDynamicClassObj();
        }
        
        $mockClass = $this->fullMockObjectFactory->createMockObject($className);
        $this->injectedMockedObjects[$className] = $mockClass;
        $mockedDynamicClassObj = $mockClass->getMockedDynamicClassObj();

        return $mockedDynamicClassObj;
    }

    /**
     * @return array
     */
    public function getInjectedMockedObjects()
    {
        return $this->injectedMockedObjects;
    }
}
