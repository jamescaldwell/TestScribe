<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Utils\Util;
use Box\TestScribe\VarExporter;

/**
 * Generate the string for setting up the mocked method
 * invocation argument expectation.
 *
 * Class MockedMethodInvocationArgumentsRenderer
 * @package Box\TestScribe\Renderers
 */
class MockedMethodInvocationArgumentsRenderer
{
    /**
     * @var \Box\TestScribe\Utils\Util
     */
    private $util;

    /**
     * @var VarExporter
     */
    private $varExporter;

    /**
     * @param \Box\TestScribe\Utils\Util        $util
     * @param \Box\TestScribe\VarExporter $varExporter
     */
    function __construct(
        Util $util,
        VarExporter $varExporter
    )
    {
        $this->util = $util;
        $this->varExporter = $varExporter;
    }

    /**
     * Given the argument value array, return the string
     * representation. This is used to generate argument list
     * for method expectations.
     * If one of the argument is an object, return ''.
     *
     * @param array $arguments
     *
     * @return string
     */
    public function renderMockedMethodArguments(
        $arguments
    )
    {
        $argArray = [];

        if ($this->util->isObjectIncluded($arguments)) {
            // We don't support objects in method expectation arguments yet.
            // @TODO (ryang 9/16/14) : support objects in method expectation
            // arguments.
            return '';
        }

        foreach ($arguments as $arg) {
            // convert the scalar value to its string representation.
            $argArray[] = $this->varExporter->exportVariable($arg);
        }

        $argumentsString = implode(', ', $argArray);

        return $argumentsString;
    }
}
