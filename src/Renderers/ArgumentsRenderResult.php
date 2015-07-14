<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

/**
 * Class ArgumentsRenderResult
 * @package Box\TestScribe
 * 
 * The result of rendering an argument list.
 */
class ArgumentsRenderResult 
{
    /**
     * @var string
     * 
     * The string representation of the argument list passed to a method
     * in the generated test file.
     */
    private $argumentString;

    /**
     * @var string
     * 
     * The statements of the generated mocks
     * used in the argument list.
     */
    private $mockStatements;

    /**
     * @param string $argumentString
     * @param string $mockStatements
     */
    function __construct($argumentString, $mockStatements)
    {
        $this->argumentString = $argumentString;
        $this->mockStatements = $mockStatements;
    }

    /**
     * @return string
     */
    public function getArgumentString()
    {
        return $this->argumentString;
    }

    /**
     * @return string
     */
    public function getMockStatements()
    {
        return $this->mockStatements;
    }
}
