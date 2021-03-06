<?php


namespace Box\TestScribe\Input;

use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Output;


/**
 */
class MenuSelector
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
     * @param string[] $menu
     *
     * @param string $msg
     *
     * @return int
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function selectFromMenu(array $menu, $msg)
    {
        $itemCount = count($menu);
        if ($itemCount < 2) {
            // There is no point of selecting from a menu with one or no item.
            throw new TestScribeException('Selecting from a menu with less than 2 items is not allowed.');
        }

        $this->output->writeln($msg);

        for ($i = 0; $i < $itemCount; $i++) {
            /** @var string $name */
            $name = $menu[$i];
            $id = (string) $i;
            $msg = "$id : $name";
            $this->output->writeln($msg);
        }

        $selectionString = $this->rawInputWithPrompt->getString();

        // @TODO (Ray Yang 9/30/15) : error handling
        $selectionId = (int) $selectionString;

        return $selectionId;
    }
}
