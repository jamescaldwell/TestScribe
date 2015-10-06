<?php

namespace Box\TestScribe\Input;

/**
 * Higher level user input methods.
 *
 * This class is designed to be used by classes outside of this namespace.
 *
 * @var InputHelper
 */
class RawInputWithHelp
{
    /** @var InputHelper */
    private $inputHelper;

    /**
     * @param \Box\TestScribe\Input\InputHelper $inputHelper
     */
    function __construct(
        InputHelper $inputHelper
    )
    {
        $this->inputHelper = $inputHelper;
    }

    /**
     * Get a string.
     *
     * @param string  $subject
     *   The description of the target that is to receive the value
     *
     * @param  string $default
     *
     * @return string
     * @throws \Box\TestScribe\Exception\AbortException
     */
    public function getString($subject, $default)
    {
        $promptMsg = "Provide the $subject.";
        if ($default !== '') {
            $promptMsg .= "\nType return for the default value ( $default ). Type 'h' for help.";
        }

        $str = $this->inputHelper->getInputString($promptMsg);
        if ($str === '') {
            $str = $default;
        }

        return $str;
    }

    /**
     * @return void
     * @throws \Box\TestScribe\Exception\AbortException
     */
    public function pause()
    {
        $this->inputHelper->getInputString('Press enter to continue...');
    }
}
