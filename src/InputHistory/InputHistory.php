<?php
/**
 *
 */

namespace Box\TestScribe\InputHistory;

use Box\TestScribe\InputHistoryPersistence;
use Box\TestScribe\InputHistory\InputHistoryData;

/**
 * Delay instantiation of this class until it is actually needed.
 * This is necessary because the engine depends @see GlobalComputedConfig
 * class to be instantiated first.
 * @Injectable(lazy=true)
 */
class InputHistory
{
    /**
     * @var InputHistoryData
     */
    private $inputHistoryData;

    /**
     * @var InputHistoryPersistence
     */
    private $inputHistoryPersistence;

    /**
     * @param \Box\TestScribe\InputHistoryPersistence $inputHistoryPersistence
     */
    function __construct(
        InputHistoryPersistence $inputHistoryPersistence
    )
    {
        $this->inputHistoryPersistence = $inputHistoryPersistence;
        $this->inputHistoryData = $inputHistoryPersistence->loadHistory();
    }

    /**
     * @return void
     */
    public function saveHistoryToFile()
    {
        $this->inputHistoryPersistence->saveHistory($this->inputHistoryData);
    }

    /**
     * Return the last used raw input string for the item.
     *
     * @param string $sectionName
     *  either method name of the class under test
     *  or dependent class name
     *
     * @param string $itemName
     *   either parameter name
     *   or dependent class's method name
     *
     * @return string
     */
    public function getInputStringFromHistory(
        $sectionName,
        $itemName
    )
    {
        $inputString = $this->inputHistoryData->getInputStringFromHistory(
            $sectionName,
            $itemName
        );

        return $inputString;
    }

    /**
     * Set the last used raw input string for the item.
     *
     * @param string $sectionName
     *  either method name of the class under test
     *  or dependent class name.
     *
     * @param string $itemName
     *   either parameter name
     *   or dependent class's method name.
     *
     * @param string $inputString
     * 
     * @return void
     */
    public function setInputStringToHistory(
        $sectionName,
        $itemName,
        $inputString
    )
    {
        $this->inputHistoryData->setInputStringToHistory(
            $sectionName,
            $itemName,
            $inputString
        );
    }
}
