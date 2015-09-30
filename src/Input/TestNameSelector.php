<?php


namespace Box\TestScribe\Input;

use Box\TestScribe\Output;


/**
 * @var RawInputWithPrompt|Output
 */
class TestNameSelector
{
    /** @var RawInputWithPrompt */
    private $rawInputWithPrompt;

    /** @var Output */
    private $output;

    /**
     * @param \Box\TestScribe\Input\RawInputWithPrompt $rawInputWithPrompt
     * @param \Box\TestScribe\Output $output
     */
    function __construct(
        RawInputWithPrompt $rawInputWithPrompt,
        Output $output
    )
    {
        $this->rawInputWithPrompt = $rawInputWithPrompt;
        $this->output = $output;
    }

    /**
     * @param string[] $existingTestNames
     *
     * @return string '' if user selects to add a new test or if the array is empty
     */
    public function selectTestName($existingTestNames)
    {
        if (!$existingTestNames) {
            return '';
        }

        $selected = '';

        $this->output->writeln("Please select an action by typing the associated number in the following menu.");

        $this->output->writeln("0 : Add a new test.");

        $length = count($existingTestNames);

        for ($i = 0; $i < $length; $i++) {
            $name = $existingTestNames[$i];
            $num = $i+1;
            $msg = "$num : Update test ( $name ).";
            $this->output->writeln($msg);
        }

        $selectionString = $this->rawInputWithPrompt->getString();

        // @TODO (Ray Yang 9/30/15) : error handling
        $selectionId = (int)$selectionString;
        if ($selectionId){
            $selected = $existingTestNames[$selectionId-1];
        }

        return $selected;
    }
}
