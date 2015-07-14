<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Class GlobalCounter
 * @package Box\TestScribe
 *
 * Provide a unique counter value per a test run.
 */
class GlobalCounter
{
    // Initialize to -1 instead of 0 so that the first counter
    // will start with 0.
    private $count = -1;

    /**
     * @return int
     */
    public function getNextCounter()
    {
        $this->count++;

        return $this->count;
    }
}
