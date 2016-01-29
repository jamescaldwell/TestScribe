<?php


namespace Box\TestScribe\Mock;

/**
 * Hold information about all mocks.
 */
class MockMgr
{
    /** @var  MockClass[] */
    private $mocks = [];

    /**
     * @param \Box\TestScribe\Mock\MockClass $mock
     * @return void
     */
    public function addMock(MockClass $mock)
    {
        $this->mocks[] = $mock;
    }

    /**
     * @return \Box\TestScribe\Mock\MockClass[]
     */
    public function getMocks()
    {
        return $this->mocks;
    }
}
