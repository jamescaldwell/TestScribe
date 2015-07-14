<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Display a prompt and get raw string from an input source
 */
class RawInputWithPrompt
{
    /**
     * @var RawInput
     */
    private $rawInput;

    /**
     * @var Output
     */
    private $output;

    /**
     * @param \Box\TestScribe\RawInput $rawInput
     * @param \Box\TestScribe\Output   $output
     */
    function __construct(
        RawInput $rawInput,
        Output $output
    )
    {
        $this->rawInput = $rawInput;
        $this->output = $output;
    }

    /**
     * Get a string.
     *
     * @return string
     */
    public function getString()
    {
        // Show a prompt symbol to make it easier for users to recognize
        // that an input is required.
        $this->output->writeln(">");

        $str = $this->rawInput->getString();

        return $str;
    }
}
