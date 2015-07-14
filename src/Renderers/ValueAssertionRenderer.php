<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Output;

/**
 * Class ValueAssertionRenderer
 * @package Box\TestScribe
 *
 * Generate code that validates a given value.
 */
class ValueAssertionRenderer
{
    /**
     * @var Output
     */
    private $output;

    /**
     * @var ObjectValueAssertionRenderer
     */
    private $objectValueAssertionRenderer;

    /**
     * @var ScalarOrNullValueAssertionRenderer
     */
    private $scalarOrNullValueAssertionRenderer;

    /**
     * @param \Box\TestScribe\Output                                       $output
     * @param \Box\TestScribe\Renderers\ObjectValueAssertionRenderer       $objectValueAssertionRenderer
     * @param \Box\TestScribe\Renderers\ScalarOrNullValueAssertionRenderer $scalarOrNullValueAssertionRenderer
     */
    function __construct(
        Output $output,
        ObjectValueAssertionRenderer $objectValueAssertionRenderer,
        ScalarOrNullValueAssertionRenderer $scalarOrNullValueAssertionRenderer
    )
    {
        $this->output = $output;
        $this->objectValueAssertionRenderer = $objectValueAssertionRenderer;
        $this->scalarOrNullValueAssertionRenderer = $scalarOrNullValueAssertionRenderer;
    }

    /**
     * Return the code to validate that the variable
     * with the given name has the value provided.
     *
     * @param string $variableName name without '$' prefix
     * @param mixed  $value
     *
     * @return string
     */
    public function generate($variableName, $value)
    {
        $statement = '';
        if (is_scalar($value) || is_null($value)) {
            $statement = $this->scalarOrNullValueAssertionRenderer->generateForAScalarOrNullValue(
                $variableName,
                $value
            );
        } else if (is_object($value)) {
            $statement = $this->objectValueAssertionRenderer->generateForAnObject($variableName, $value);
        } else if (is_array($value)) {
            $statement = $this->generateForAnArray($variableName, $value);
        } else {
            $this->showWarning($variableName, $value);
        }

        return $statement;
    }

    /**
     * Generate assertions of an array.
     *
     * @param string $variableName name without '$' prefix
     * @param array  $anArray
     *
     * @return string
     */
    private function generateForAnArray($variableName, array $anArray)
    {
        $arraySize = count($anArray);
        $statementsString =
            "\$this->assertInternalType('array', \$$variableName);\n"
            . "\$this->assertCount($arraySize, \$$variableName);";
        
        foreach ($anArray as $key => $itemValue) {
            $keyAsCodeString = var_export($key, true);
            $itemVariableName = $variableName . '[' . $keyAsCodeString . ']';
            //Recursively call generate for each element.
            $statement = $this->generate($itemVariableName, $itemValue);
            $statementsString .= "\n$statement";
        }

        return $statementsString;
    }

    /**
     * Show a warning.
     *
     * @param string $variableName name without '$' prefix
     * @param mixed  $value
     *
     * @return void
     */
    private function showWarning($variableName, $value)
    {
        $typeString = gettype($value);
        $msg = "Assertion for a variable ( $variableName ) with type ( $typeString ) is not supported yet.";
        $this->output->writeln($msg);
    }
}
