<?php

namespace Box\TestScribe\Examples\CombinatorialExplosion;
/**
 * Demonstrates:
 *
 * How unit tests can help deal with the combinatorial explosion
 * challenges.
 *
 * How the tool can reduce the cost of the unit test approach.
 *
 * @var BothTrueLevel2
 */
class UnitTestApproach
{
    /** @var BothTrueLevel2 */
    private $bothTrueLevel2;

    /**
     * @param BothTrueLevel2 $bothTrueLevel2
     */
    function __construct(
        BothTrueLevel2 $bothTrueLevel2
    )
    {
        $this->bothTrueLevel2 = $bothTrueLevel2;
    }

    /**
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
    public function isAllTrue($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8)
    {
        $r1 = $this->bothTrueLevel2->f2($p1, $p2, $p3, $p4);
        $r2 = $this->bothTrueLevel2->f2($p5, $p6, $p7, $p8);

        return $r1 && $r2;
    }
}
