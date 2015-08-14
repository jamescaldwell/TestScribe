<?php

namespace Box\TestScribe\Config;

use Box\TestScribe\App;
use Box\TestScribe\PHPClassTokenizer;
use Box\TestScribe\Input\UserInput;

/**
 * Class ClassExtractor - Utility class to extract class information from php file
 * @package Box\TestScribe
 */
class ClassExtractor
{
    /**
     * @param string $file
     * @param string $methodName
     *
     * @return string
     */
    public function getClassName($file, $methodName)
    {
        $tokenizer = new PHPClassTokenizer($file);
        $tokenizer->parseAndSetClassNameAndNamespace();
        $classes = $tokenizer->getClassesDeclared();
        $class = $classes[0];
        if (count($classes) > 1) {
            $class = $this->handleMultipleClasses($classes, $methodName);
        }

        return $class;
    }

    /**
     * @param string[] $classes
     * @param string   $methodName
     *
     * @return string
     */
    private function handleMultipleClasses($classes, $methodName)
    {
        $validClasses = $this->getValidClasses($classes, $methodName);
        $count = count($validClasses);
        if ($count === 1) {
            return $validClasses[0];
        }
        if ($count > 1) {
            App::writeln("Found multiple valid classes: \n");
            for ($i = 0; $i < $count; $i++) {
                $message = sprintf("%d %s\n", $i, $validClasses[$i]);
                App::writeln($message);
            }
            $message = sprintf(
                "Enter number 0 - %s representing class intended.",
                $count - 1
            );
            App::writeln($message);
            $userInputObj = new UserInput();
            $input = $userInputObj->getInteger();

            return $validClasses[$input];
        }
        App::writeln("No valid class found");

        return '';
    }

    /**
     * @param string[] $classes
     * @param string   $methodName
     *
     * @return string[]
     */
    private function getValidClasses($classes, $methodName)
    {
        $validClasses = [];
        foreach ($classes as $class) {
            $reflectionClass = new \ReflectionClass($class);
            try {
                $method = $reflectionClass->getMethod($methodName);
                if ($method) {
                    $validClasses[] = $class;
                }
            } catch (\ReflectionException $re) {
                // nothing to do. Just ignore
            }
        }

        return $validClasses;
    }
}
