<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

/**
 * Class MockingTestUsage
 * @package Box\TestScribe\_fixture\_input
 */
class MockingTestUsage 
{
    /**
     * @param \Box\TestScribe\_fixture\_input\MockingTest $mt
     *
     * @return string
     */
    public function callDupMethod(MockingTest $mt)
    {
        $r = $mt->dup();
        
        return $r;
    }
    
    /**
     * @param \Box\TestScribe\_fixture\_input\MockingTest $mt
     *
     * @return string
     */
    public function callDupTraitMethod(MockingTest $mt)
    {
        $r = $mt->dupTrait();
        
        return $r;
    }
    
}
