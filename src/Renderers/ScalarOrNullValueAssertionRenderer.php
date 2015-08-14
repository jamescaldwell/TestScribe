<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Utils\VarExporter;

/**
 */
class ScalarOrNullValueAssertionRenderer
{
    /**
     * @var VarExporter
     */
    private $varExporter;

    /**
     * @param \Box\TestScribe\Utils\VarExporter         $varExporter
     */
    function __construct(
        VarExporter $varExporter
    )
    {
        $this->varExporter = $varExporter;
    }

    /**
     * Generate assertions of a scalar or null value.
     *
     * @param string $variableName name without '$' prefix
     * @param mixed  $value
     *
     * @return string
     */
    public function generateForAScalarOrNullValue($variableName, $value)
    {
        // @TODO (ryang 12/18/14) : handle float type differently.
        // due to the imprecision of using var_export output to represent a float value
        // the generated statement may fail under different machines.
        $valueRepresentationAsCode = $this->varExporter->exportVariable($value);
        $failureMsg = "Variable ( $variableName ) doesn't have the expected value.";

        // Use var_export directly since the message is a string 
        // and it doesn't contain a return character.
        // This is done to make it easier to generate unit tests.
        $failureMsgAsCode = var_export($failureMsg, true);
        $statement = <<<STRINGEND
\$expected = $valueRepresentationAsCode;
\$this->assertSame(
    \$expected,
    \$$variableName,
    $failureMsgAsCode
);
STRINGEND;

        return $statement;
    }
}
