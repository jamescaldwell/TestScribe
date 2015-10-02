<?php


namespace Box\TestScribe\Input;

/**
 * @var MenuSelector
 */
class TestNameSelector
{
    /** @var MenuSelector */
    private $menuSelector;

    /**
     * @param \Box\TestScribe\Input\MenuSelector $menuSelector
     */
    function __construct(
        MenuSelector $menuSelector
    )
    {
        $this->menuSelector = $menuSelector;
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
        $menu = $existingTestNames;
        array_unshift($menu, 'Add a new test.');
        $selectionId = $this->menuSelector->selectFromMenu(
            $menu,
            'Update an existing test or adding a new test?');

        if ($selectionId){
            $selected = $menu[$selectionId];
        }

        return $selected;
    }
}
