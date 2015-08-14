<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Input\RawInputWithHelp;

/**
 * Class InputValueGetter
 * @package Box\TestScribe
 *
 * Gather raw user input for a value with input history support.
 */
class InputWithHistory
{
    /**
     * @var RawInputWithHelp
     */
    private $rawInputWithHelp;

    /**
     * @var InputHistory
     */
    private $inputHistory;

    /**
     * @param \Box\TestScribe\Input\RawInputWithHelp $rawInputWithHelp
     * @param \Box\TestScribe\InputHistory     $inputHistory
     */
    function __construct(
        RawInputWithHelp $rawInputWithHelp,
        InputHistory $inputHistory
    )
    {
        $this->rawInputWithHelp = $rawInputWithHelp;
        $this->inputHistory = $inputHistory;
    }

    /**
     * @param string $subject
     *   The description of the target that is to receive the value
     *
     * @param string $className '' if the class under test
     * @param string $methodName
     * @param string $paramName
     *
     * @return string
     */
    public function getInputValue(
        $subject,
        $className,
        $methodName,
        $paramName
    )
    {
        $default = $this->loadHistory(
            $className,
            $methodName,
            $paramName
        );
        // @TODO (ryang 1/9/15) : allow users to retry when they make a typo.
        $expression = $this->rawInputWithHelp->getString($subject, $default);
        $this->saveHistory(
            $className,
            $methodName,
            $paramName,
            $expression
        );

        return $expression;
    }

    /**
     * @param string $className '' if the class under test
     * @param string $methodName
     * @param string $paramName
     *
     * @return string
     */
    private function loadHistory(
        $className,
        $methodName,
        $paramName
    )
    {
        if ($className !== '') {
            // This is for the return value of a mocked method call
            $default = $this->inputHistory->getInputStringFromHistory(
                $className,
                $methodName
            );
        } else {
            // This is for a parameter
            $default = $this->inputHistory->getInputStringFromHistory(
                $methodName,
                $paramName
            );
        }

        return $default;
    }

    /**
     * @param string $className '' if the class under test
     * @param string $methodName
     * @param string $paramName
     *
     * @param string $expression
     *
     * @return void
     */
    private function saveHistory(
        $className,
        $methodName,
        $paramName,
        $expression
    )
    {
        $inputHistory = $this->inputHistory;
        
        if ($className !== '') {
            // This is for the return value of a mocked method call
            $inputHistory->setInputStringToHistory(
                $className,
                $methodName,
                $expression
            );
        } else {
            // This is for a parameter
            $inputHistory->setInputStringToHistory(
                $methodName,
                $paramName,
                $expression
            );
        }

        // @TODO (ryang 4/22/15) : optimize by saving history to disk less frequently
        // after we catch generator exceptions and save history before existing.
        $inputHistory->saveHistoryToFile();
    }
}
