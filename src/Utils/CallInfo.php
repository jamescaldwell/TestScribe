<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use JsonSerializable;

/**
 * Information about a method call.
 *
 * Class CallInfo
 * @package Box\TestScribe\Utils
 */
class CallInfo implements JsonSerializable
{
    private $fileName;
    private $lineNumberString;

    /**
     * @param string $fileName
     * @param string $lineNumberString
     */
    function __construct($fileName, $lineNumberString)
    {
        $this->fileName = $fileName;
        $this->lineNumberString = $lineNumberString;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getLineNumberString()
    {
        return $this->lineNumberString;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return [
            'fileName' => $this->fileName,
            'lineNumberString' => $this->lineNumberString,
        ];
    }
}
