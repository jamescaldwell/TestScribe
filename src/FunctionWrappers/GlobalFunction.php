<?php
/**
 *
 */

namespace Box\TestScribe\FunctionWrappers;

/**
 * Wrapper for global functions
 *
 * Makes it possible to mock out global function calls.
 * 
 * @method bool file_exists($filename)
 * @method string file_get_contents ($filename, $flags = null, $context = null, $offset = null, $maxlen = null)
 * @method int|false file_put_contents ($filename, $data, $flags = null, $context = null)
 */
class GlobalFunction
{
    /**
     * @param string $name
     * @param array  $args
     *
     * @return mixed
     */
    public function __call(
        $name,
        array $args
    )
    {
        $rc = call_user_func_array($name, $args);
        
        return $rc;
    }
}
