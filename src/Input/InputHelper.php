<?php


namespace Box\TestScribe\Input;

use Box\TestScribe\Exception\AbortException;
use Box\TestScribe\Output;

/**
 */
class InputHelper 
{
    /**
     * @var RawInputWithPrompt
     */
    private $rawInputWithPrompt;

    /**
     * @var Output
     */
    private $output;

    /**
     * @param \Box\TestScribe\Input\RawInputWithPrompt $rawInputWithPrompt
     * @param \Box\TestScribe\Output                   $output
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
     * Get an input string.
     *
     * Handles interactive help and abort commands.
     *
     * @param string $msg
     *
     * @return string
     * @throws \Box\TestScribe\Exception\AbortException
     */
    public function getInputString($msg)
    {
        $this->output->writeln($msg);

        $str = '';
        while (true) {
            $str = $this->rawInputWithPrompt->getString();

            if ($str === 'h') {
                $this->showHelp();
            } else if ($str === 'a') {
                throw new AbortException('Abort upon a user request');
            } else {
                break;
            }
        }

        return $str;
    }

    /**
     * @return void
     */
    private function showHelp()
    {
        $helpMsg = <<<'TAG'
-------------------------------------------------------------
Input help:

+++ Value input:

Specify the input in PHP format.

Use fully qualified class names in place of object variables.
They will be mocked automatically.

Use the word void to select the default value for a parameter,
or a void return value.

e.g.

"ab", 'a', "a\n"
true, false, 1, null,
["a", "b"], ["a" => 2], ["a" => ["b" => [ 1, 2]]]
\ClassFoo , \Namespace1\ClassBar
[\ClassFoo, \ClassBar]
['key' => \ClassFoo]
void


+++ Other commands:

a : abort this test generation run.

End of help
=============================================================
TAG;
        $this->output->writeln($helpMsg);
    }
}
