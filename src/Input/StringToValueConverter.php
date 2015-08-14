<?php
/**
 *
 */

namespace Box\TestScribe\Input;

/**
 * Class StringToValueConverter
 * Convert a raw string to a PHP value
 *
 * @package Box\TestScribe
 */
class StringToValueConverter 
{
    /**
     * Convert the given string to a value based on PHP syntax rules.
     * e.g. "ab", true, 1, 1.1, ['a', 'b'], ["a" => 2],
     * ['a' => ["b" => [ 1, 2]]], null
     *
     * @param string $expression
     * @param array  $existingVariables variable name => value
     *  variables and value that the expression string is able to reference
     * 
     * @return mixed
     */
    public function convert($expression, array $existingVariables)
    {
        // Bring the pre-defined variables into the current scope.
        extract($existingVariables);
        
        // Initialize this variable to avoid intellij to complain
        // about undeclared local variable error.
        $rc = null;
        $statement = sprintf('$rc = %s;', $expression);

        // This will convert the input string into the variable
        // of the local variable $rc.
        eval($statement);

        return $rc;
    }
}
