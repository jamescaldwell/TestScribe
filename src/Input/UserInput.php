<?php

namespace Box\TestScribe\Input;

use Box\TestScribe\App;
use Box\TestScribe\GeneratorException;
use Box\TestScribe\PHPDoc\PHPDocType;

/**
 * Handle getting user inputs.
 *
 * Class UserInput
 *
 * @package Box\TestScribe
 */
class UserInput
{
    /**
     * @return string
     */
    private function getInstructionForValueInputMsg()
    {
        // use a method instead of a constant because constant
        // doesn't allow expressions.
        $msg = "To input a primitive type, specify the input in PHP format.\n" .
            'e.g. null, true, 1, 1.1, ["a", "b"], ["a" => 2], ["a" => ["b" => [ 1, 2]]], "ab",' .
            " 'a'.\n";
        $msg .= "To input a class, enter the pound symbol (#) followed by the class name.\n" .
            "e.g. to input class Box_User type: #Box_User\n";

        return $msg;
    }

    /**
     * Get a mixed value by asking users to give a value in PHP code format.
     * e.g. "ab", true, 1, 1.1, ['a', 'b'], ["a" => 2],
     * ['a' => ["b" => [ 1, 2]]], null
     *
     * Class and primitive types are supported.
     *
     * @return mixed
     */
    public function getMixed()
    {
        $msg = $this->getInstructionForValueInputMsg();
        $str = $this->getStringWithMessage($msg);
        $rc = $this->convertStringToValue($str);

        return $rc;
    }

    /**
     * Get a value or class name from a composite type which includes object types.
     *
     * @param string[] $classNamesWithIndex
     *  index => class name array
     * @param bool  $valueTypeAllowed
     *  true if at least one type is a value type.
     *
     * @throws GeneratorException
     * @return array
     *  [className, value] one of them is null.
     */
    public function getClassNameOrPrimitiveValue($classNamesWithIndex, $valueTypeAllowed)
    {
        $classChoiceMsg = "Object types are expected. \n";
        foreach ($classNamesWithIndex as $index => $className) {
            $classChoiceMsg .= "Type ( #$index ) to select class ( $className ).\n";
        }
        if ($valueTypeAllowed) {
            $classChoiceMsg .= $this->getInstructionForValueInputMsg();
        }
        $str = $this->getStringWithMessage($classChoiceMsg);

        // Match string that starts with # character followed by one diget.
        // It's acceptable for now to support up to 10 classes in a composite type.
        // Capture the diget in the capturing group.
        $regExpressionPattern = '/^#(\d)$/';
        $regResult = preg_match(
            $regExpressionPattern,
            $str,
            $matches
        );
        if ($regResult) {
            $selectionNumber = $matches[1];
            if (array_key_exists($selectionNumber, $classNamesWithIndex)) {
                $selectedClass = $classNamesWithIndex[$selectionNumber];

                return [$selectedClass, null];
            } else {
                $errMsg = "Your selection of $selectionNumber doesn't exist. Please try again.";
                throw new GeneratorException($errMsg);
            }
        } elseif ($valueTypeAllowed) {
            // @TODO (ryang 9/11/14) : handle errors
            $value = $this->convertStringToValue($str);

            return [null, $value];
        } else {
            $errMsg = "Please use #<number> format to select a class type. Please try again.";
            throw new GeneratorException($errMsg);
        }
    }

    /**
     * Convert the given string to a value based on PHP syntax rules.
     * e.g. "ab", true, 1, 1.1, ['a', 'b'], ["a" => 2],
     * ['a' => ["b" => [ 1, 2]]], null
     *
     * Only primitive types including array types are supported.
     *
     * @param string $str
     *
     * @return mixed
     */
    private function convertStringToValue($str)
    {
        // Initialize this variable to avoid intellij to complain
        // about undeclared local variable error.
        $rc = null;
        if(strpos($str, '#') !== 0 ) {
            $statement = sprintf('$rc = %s;', $str);

            // This will convert the input string into the variable
            // of the local variable $rc.
            eval($statement);
        } else {
            // case where we have a special string representing class and would crash eval
            $rc = $str;
        }

        return $rc;
    }

    /**
     * Get an integer value from users.
     *
     * @return int
     * @throws \RuntimeException
     */
    public function getInteger()
    {
        $str = $this->getString();
        if (!is_numeric($str)) {
            $msg = sprintf(
                "The input ( %s ) is not an integeter.",
                $str
            );
            // @TODO (ryang 8/21/14) : allow users to retry.
            throw new \RuntimeException($msg);
        }
        $value = intval($str);

        return $value;
    }

    /**
     * Get an array from users.
     * The array should be specified in a valid JSON format.
     *
     * @see http://php.net/manual/en/function.json-decode.php
     *      for supported JSON formats.
     *
     * @return array
     */
    public function getArray()
    {
        $str = $this->getStringWithMessage(
            "Please provide an array in JSON format. \n"
            . 'Examples: ["foo", "bar"], [ 1 ,2 ] , [true, false], { "a": 2, "bc": 5 }'
        );

        // Returned objects will be converted into associative arrays
        // when the input represents one.
        $arr = json_decode($str, true);

        return $arr;
    }

    /**
     * Show the given message and get a string from users.
     *
     * @param string $message
     *
     * @return string
     */
    public function getStringWithMessage($message)
    {
        App::writeln($message);
        $str = $this->getString();

        return $str;
    }

    /**
     * Prompt users for a yes or no answer.
     *
     * @return bool
     */
    public function getBoolean()
    {
        App::writeln(
            "Please answer yes or no by typing 'y' or return for yes, 'n' for no."
        );
        // @TODO (ryang 8/15/14) : get input from input interface to allow
        // easier unit testing.
        $answer = $this->getString();
        if ($this->isAnswerYes($answer)) {
            $input = true;
        } else {
            $input = false;
        }

        return $input;
    }

    /**
     * Get a value of the given type from users.
     *
     * @param PHPDocType $type
     *
     * @throws \RuntimeException
     * @return bool|string|array
     */
    public function getValue($type)
    {
        $rc = null;
        if ($type->isComposite()) {
            $type = $this->getSingleTypeFromComposite($type);
        }

        $typeString = $type->getRepresentation();
        if ($type->isArray()) {
            $rc = $this->getArray();
        } else if ($type->isPrimitiveType()) {
            $rc = $this->getPrimitive($typeString);
        } else {
            $msg = "Getting the value of the type ( $typeString ) is not supported yet." .
                " Please file an enhancement request.";
            throw new \RuntimeException($msg);
        }

        return $rc;
    }


    /**
     * Prompt users to select a type from a list of types.
     *
     * @param PHPDocType $type
     *
     * @return PHPDocType
     */
    public function getSingleTypeFromComposite($type)
    {
        $types = $type->getTypes();

        $count = count($types);
        $message = sprintf(
            'Found multiple types ( %s ). Please enter the type desired: ',
            $type
        );
        App::writeln($message);
        for ($i = 0; $i < $count; $i++) {
            $message = sprintf("%d %s", $i, $types[$i]->getRepresentation());
            App::writeln($message);
        }
        $message = sprintf(
            "Enter number 0 - %s representing type intended.",
            $count - 1
        );
        App::writeln($message);
        $userInputObj = new UserInput();
        $input = $userInputObj->getInteger();
        return $types[$input];
    }

    /**
     * Get a string from users.
     *
     * @return string
     */
    private function getString()
    {
        $str = readline();

        return $str;
    }

    /**
     * Return true if the answer string is 'n' or 'N'.
     *
     * @param string $answerString
     *
     * @return bool
     */
    private function isAnswerYes($answerString)
    {
        $rc = true;
        $answer = strtolower($answerString);
        if ($answer === 'n') {
            $rc = false;
        }

        return $rc;
    }

    /**
     * @param PHPDocType $type
     *
     * @return bool|int|null|string
     * @throws \RuntimeException
     */
    private function getPrimitive($type)
    {
        $rc = null;
        switch ($type) {
            case 'string':
                $rc = $this->getString();
                break;
            case 'bool':
            case 'boolean':
                $rc = $this->getBoolean();
                break;
            case 'int':
            case 'integer':
                $rc = $this->getInteger();
                break;
            default:
                $errMsg = sprintf(
                    "Getting the value of the type ( %s ) is not supported yet.",
                    $type
                );
                throw new \RuntimeException($errMsg);
        }
        return $rc;
    }
}
