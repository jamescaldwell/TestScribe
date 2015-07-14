<?php

namespace Box\TestScribe;

use Box\TestScribe\PHPDoc;
use Box\TestScribe\Utils\Util;
use InvalidArgumentException;

/**
 * Class Assert
 * @package Box\TestScribe
 */
class Assert
{
    /** @var Assert[] */
    private static $assert_arr = array();

    /** @var null|string */
    private $exception_class = null;

    /** @var array */
    private $exception_args;

    /**
     * @param string $exception_name the name of the exception class to use.
     * @param array $args
     * @throws InvalidArgumentException if the class name refers to an incorrect class.
     */
    private function __construct($exception_name, $args)
    {
        if (!is_subclass_of($exception_name, 'Exception')) {
            throw new \InvalidArgumentException(sprintf("%s is not a valid subclass of Exception", $exception_name));
        }
        $this->exception_class = $exception_name;
        $this->exception_args = $args;
    }

    /**
     * @static
     * @param string $exception_name
     * @param array $args
     * @return Assert
     */
    public static function with($exception_name, $args = array())
    {
        if (!array_key_exists($exception_name, self::$assert_arr) || count($args) !== 0) {
            $Assert = new Assert($exception_name, $args);
            self::$assert_arr[$exception_name] = $Assert;
        }

        return self::$assert_arr[$exception_name];
    }

    /**
     * @param mixed|null $statement
     * @param string|void $message
     * @return Assert
     */
    public function is_true($statement, $message="")
    {
        if ($statement !== true) {
            $this->throw_exception($this->format_message("The statement %s was not true", $statement), $message);
        }

        return $this;
    }

    /**
     * @param mixed|null $statement
     * @param string|void $message
     * @return Assert
     */
    public function is_false($statement, $message="")
    {
        if ($statement !== false) {
            $this->throw_exception($this->format_message("The value %s was not false (it is a %s)", $statement, gettype($statement)), $message);
        }

        return $this;
    }

    /**
     * @param mixed|null $expected
     * @param mixed|null $actual
     * @param string|void $message
     * @return Assert
     */
    public function are_not_equal($expected, $actual, $message="")
    {
        if ($expected == $actual) {
            $this->throw_exception($this->format_message("both inputs were %s, but should have been different", $expected, $actual), $message);
        }

        return $this;
    }

    /**
     * @param mixed|null $expected - The expected value.
     * @param mixed|null $actual - The actual value. Note that if you are testing equality against an expected string type you
     * should ALWAYS use are_same() instead of are_equal() due to the bug-prone nature of comparison between
     * strings and integers.
     * @param string|void $message
     * @return Assert
     */
    public function are_equal($expected, $actual, $message="")
    {
        if ($expected != $actual) {
            $this->throw_exception($this->format_message("Expected %s, but it was %s", $expected, $actual), $message);
        }

        return $this;
    }

    /**
     * @param mixed|null $thing
     * @param string|void $message
     * @return Assert
     */
    public function is_not_null($thing, $message="")
    {
        if (is_null($thing)) {
            $this->throw_exception("The given value should not have been null", $message);
        }

        return $this;
    }

    /**
     * @param string $generated_message
     * @param string $message
     * @return void
     * @throws mixed exception type, specified in the constructor to the Assert instance.
     */
    private function throw_exception($generated_message, $message)
    {
        $cls = $this->exception_class;
        $full_message = "$message\n$generated_message";
        $arguments = array($full_message);
        $arguments = Util::array_join_values($this->exception_args, $arguments);
        $reflection = new \ReflectionClass($cls);
        /** @var $exception \Exception */
        $exception = $reflection->newInstanceArgs($arguments);
        throw $exception;
    }

    /**
     * @param string $message
     * @return mixed
     */
    private function format_message($message/*, $arg1, $arg2, ... $argN */)
    {
        $args = func_get_args();
        $formatted_args = array();
        array_shift($args);
        foreach ($args as $argument) {
            if ($argument === null) {
                $formatted_args[] = '<null>';
            } elseif ($argument === false) {
                $formatted_args[] = '<false>';
            } else {
                $formatted_args[] = print_r($argument, true);
            }
        }
        array_unshift($formatted_args, $message);

        return call_user_func_array('sprintf', $formatted_args);
    }

}

