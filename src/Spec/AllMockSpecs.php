<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Mock\MockMgr;


/**
 * @var MockSpecFactory|MockMgr
 */
class AllMockSpecs
{
    /** @var MockSpecFactory */
    private $mockSpecFactory;

    /** @var MockMgr */
    private $mockMgr;

    /**
     * @param \Box\TestScribe\Spec\MockSpecFactory $mockSpecFactory
     * @param \Box\TestScribe\Mock\MockMgr         $mockMgr
     */
    function __construct(
        MockSpecFactory $mockSpecFactory,
        MockMgr $mockMgr
    )
    {
        $this->mockSpecFactory = $mockSpecFactory;
        $this->mockMgr = $mockMgr;
    }

    /**
     * @return \Box\TestScribe\Spec\MockSpec[]
     */
    public function getAllMockSpecs()
    {
        $mocks = $this->mockMgr->getMocks();
        $mockSpecs = [];
        foreach($mocks as $oneMock){
            $spec = $this->mockSpecFactory->createMockSpecFromMockClass($oneMock);
            $mockSpecs[]= $spec;
        }

        return $mockSpecs;
    }
}
