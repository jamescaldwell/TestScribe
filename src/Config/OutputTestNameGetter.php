<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\GeneratorException;
use Box\TestScribe\Output;
use Box\TestScribe\RawInputWithPrompt;


/**
 * @var RawInputWithPrompt|Output
 *
 * The Output dependency is not ready when this class
 * is resolved.
 * So this class has to be lazily resolved.
 * @Injectable(lazy=true)
 *
 * Making Output class lazy doesn't help since the current php-di
 * implementation doesn't seem to look up if an instance
 * is registered when the proxy is resolved to a real one.
 */
class OutputTestNameGetter
{
    /** @var RawInputWithPrompt */
    private $rawInputWithPrompt;

    /** @var Output */
    private $output;

    /**
     * @param \Box\TestScribe\RawInputWithPrompt $rawInputWithPrompt
     * @param \Box\TestScribe\Output             $output
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
     * Get the name of the test to create.
     * Method has to begin with 'test'
     *
     * @param string $methodName
     * @param bool   $useDefaultTestMethodName
     *
     * @throws GeneratorException
     * @return string
     */
    public function getTestName(
        $methodName,
        $useDefaultTestMethodName
    )
    {
        $defaultTestMethodName = "test_$methodName";

        if ($useDefaultTestMethodName) {
            return $defaultTestMethodName;
        }

        $message =
            "Enter the name of the test. Press enter to use the default test name ( $defaultTestMethodName ).";

        $this->output->writeln($message);

        // rawInput is used instead of InputWithHelp so that
        // users don't have to quote the name as instructed by the help.
        $input = $this->rawInputWithPrompt->getString($message);
        if ($input === '') {
            return $defaultTestMethodName;
        }
        if (0 !== strpos($input, 'test')) {
            $error =
                "Test method must begin with the string 'test'. Please try again.";
            throw new GeneratorException($error);
        }

        return $input;
    }
}
