<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Miscellaneous tests
 * Class Misc
 */
class Misc
{
    /**
     * Given a dictionary with a word string and a count.
     * Return a new dictionary with the count doubled.
     *
     * @param array $wordWithCountArray
     *  word string => count int
     *
     * @return array
     */
    public function doubleCounts($wordWithCountArray)
    {
        $doubled = [];
        foreach ($wordWithCountArray as $word => $count) {
            $doubled[$word] = 2 * $wordWithCountArray[$word];
        }

        return $doubled;
    }

    /**
     * @param mixed|User $value
     *
     * @return mixed
     */
    public function echoValue($value)
    {
        if (gettype($value) === "object") {
            return $value->getName();
        }
        return $value;
    }
}
