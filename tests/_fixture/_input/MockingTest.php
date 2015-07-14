<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

/**
 * Class MockingTest
 * @package Box\TestScribe\_fixture\_input
 * 
 * Test classes for testing mocking behaviors.
 */
class MockingTest implements MockingTestInterface
{
    use MockingTestTrait {
        dup as dupTrait;
    }
    
    /**
     * @return string
     */
    public function dup(){
        return 'dup called.';
    }
    
}
