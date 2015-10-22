<?php

namespace Box\TestScribe\Examples\CombinatorialExplosion;
/**
 * Demonstrates:
 *
 * How unit tests can help deal with the combinatorial explosion
 * challenges.
 *
 * How the tool can reduce the cost of the unit test approach.
 */
class Simple
{
    /**
     * Simple implementation.
     *
     * Using a black box testing approach, 2^8 = 256 test cases
     * are needed to cover all scenarios.
     *
     * @param $p1
     * @param $p2
     * @param $p3
     * @param $p4
     * @param $p5
     * @param $p6
     * @param $p7
     * @param $p8
     * @return bool
     */
    static public function isAllTrue($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8)
    {
        return $p1 && $p2 && $p3 && $p4 && $p5 && $p6 && $p7 && $p8;
    }
}
