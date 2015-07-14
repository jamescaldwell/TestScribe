<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

use Box\TestScribe\_fixture\ServiceLocator;

/**
 * Class PartialMockingExample
 * @package Box\TestScribe\_fixture\_input
 * 
 * Used to test partial mocking
 */
class PartialMockingExample 
{
    /**
     * @var CalculatorFactory
     */
    private $factory;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param \Box\TestScribe\_fixture\_input\CalculatorFactory $factory
     */
    function __construct(
        CalculatorFactory $factory
    )
    {
        $this->factory = $factory;
        $this->logger = ServiceLocator::resolve('\Box\TestScribe\_fixture\_input\Logger');
    }

    /**
     * @return int
     */
    public function calc()
    {
        $r = $this->internalCalc();
        $rc = $this->addOne($r);
        $this->logger->log("internal calc called");
        
        return $rc;
    }

    /**
     * @return int
     */
    protected function internalCalc()
    {
        $calc = $this->factory->getCalculator(1);
        $r = $calc->add(2);
        
        return $r;
    }

    /**
     * @param int $input
     *
     * @return int
     */
    private function addOne($input)
    {
        return $input+1;
    }
}
