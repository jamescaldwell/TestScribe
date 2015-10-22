<?php


namespace Box\TestScribe\Examples\CombinatorialExplosion;


/**
 * @var BothTrue
 */
class BothTrueLevel2
{

    /** @var BothTrue */
    private $bothTrue;

    /**
     * @param BothTrue $bothTrue
     */
    function __construct(
        BothTrue $bothTrue
    )
    {
        $this->bothTrue = $bothTrue;
    }

    /**
     * @param $p1
     * @param $p2
     * @param $p3
     * @param $p4
     * @return bool
     */
    public function f2($p1, $p2, $p3, $p4)
    {
        $r1 = $this->bothTrue->f1($p1, $p2);
        $r2 = $this->bothTrue->f1($p3, $p4);

        return $r1 && $r2;
    }
}
