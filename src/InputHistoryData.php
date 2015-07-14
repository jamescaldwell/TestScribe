<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Utils\ArrayUtil;
use JsonSerializable;

/**
 * Class InputHistoryData
 * @package Box\TestScribe
 * 
 * In memory input history data holder.
 */
class InputHistoryData implements JsonSerializable
{
    private $data = [];

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
        $inputString = '';
        
        $sectionArray = ArrayUtil::lookupValueByKey(
            $sectionName,
            $this->data,
            null
        );
        
        if ($sectionArray !== null){
            $inputString = ArrayUtil::lookupValueByKey(
                $itemName,
                $sectionArray,
                ''
            );
        }

        return $inputString;
    }

    /**
     * Set the last used raw input string for the parameter of the method under test.
     *
     * @param string $sectionName 
     *  either method name of the class under test
     *  or dependent class name
     * 
     * @param string $itemName
     *   either parameter name
     *   or dependent class's method name
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
        $this->data[$sectionName][$itemName] = $inputString;
    }

    /**
     * Return all the data.
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
    
    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * 
     * @return array
     */
    function jsonSerialize()
    {
        return $this->data;
    }
}
