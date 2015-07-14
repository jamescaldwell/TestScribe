<?php

namespace Box\TestScribe;

/**
 * Representation of the test file to generate unit test in
 * Class GeneratedTestFile
 * @package Box\TestScribe
 */
class GeneratedTestFile {

    /**
     * Get the name of the test to create.
     * Method has to begin with 'test'
     *
     * @param string $className
     * @param string $methodName
     * @param bool   $useDefaultTestMethodName
     *
     * @throws \RuntimeException
     * @return string
     */
    public static function getTestName(
        $className,
        $methodName,
        $useDefaultTestMethodName
    )
    {
        // Convert the first letter of the method name to upper case
        // to make the result a valid camel case.
        $defaultTestMethodName = 'test' . ucfirst($methodName);

        if ($useDefaultTestMethodName) {
            return $defaultTestMethodName;
        }

        $message = sprintf(
            "Enter the name of the test for the method ( %s ) of the class ( %s ).\n"
            . "Press enter to use the default test name ( %s ).",
            $methodName,
            $className,
            $defaultTestMethodName
        );
        $userInputObj = new UserInput();
        $input = $userInputObj->getStringWithMessage($message);
        if ($input === '') {
            return $defaultTestMethodName;
        }
        if (0 !== strpos($input, 'test')) {
            $error = sprintf(
                "Test method must begin with the string 'test'. Please try again."
            );
            throw new \RuntimeException($error);
        }

        return $input;
    }
}
