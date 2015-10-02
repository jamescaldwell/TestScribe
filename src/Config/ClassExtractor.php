<?php

namespace Box\TestScribe\Config;

/**
 * Class ClassExtractor - Utility class to extract class information from php file
 * @package Box\TestScribe
 */
class ClassExtractor
{
    /**
     * @param string $file
     *
     * @return string
     */
    public function getClassName($file)
    {
        $tokenizer = new PHPClassTokenizer($file);
        $tokenizer->parseAndSetClassNameAndNamespace();
        $classes = $tokenizer->getClassesDeclared();
        $class = $classes[0];
        if (count($classes) > 1) {
            // @TODO (Ray Yang 10/1/15) : warn that
            // only the first class in the file can be tested.
        }

        return $class;
    }
}
