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
 * This is a simplified example.
 * A real world example would likely to be much more complex.
 * The inputs may come from a configuration file, HTTP GET parameters,
 * a database, feature flip flags etc.
 * Setting up a test scenario to hit a given code path is likely
 * going to be more complex too.
 *
 * The more complex the program becomes, the benefit of a unit
 * test approach would become bigger.
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
