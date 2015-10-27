<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\Mock\MockClass;

/**
 * Class ValueTransformer
 */
class ValueTransformer
{
    /**
     * @param mixed $value
     * @param bool $replaceMockObjectWithObjectName
     * true if $mockObjectName should be used instead of a more user readable name.
     *
     * @return mixed Recursively translate any object or resource contained in
     * this value to its string representation.
     *
     * Recursively translate any object or resource
     * contained in this value to its string representation.
     */
    public function translateObjectsAndResourceToString(
        $value,
        $replaceMockObjectWithObjectName = false
    )
    {
        if (is_object($value)) {
            $result = $this->translateObjectToString($value, $replaceMockObjectWithObjectName);

            return $result;
        }

        if (is_array($value)) {
            $simpleArray = [];
            foreach ($value as $index => $element) {
                $simpleArray[$index] =
                    $this->translateObjectsAndResourceToString(
                        $element,
                        $replaceMockObjectWithObjectName
                    );
            }

            return $simpleArray;
        }

        if (is_resource($value)) {
            $type = get_resource_type($value);
            $result = "resource ( $type )";

            return $result;
        }

        return $value;
    }

    /**
     * @param object $value
     *
     * @param bool $replaceMockObjectWithClassName
     *
     * @return string
     */
    private function translateObjectToString($value, $replaceMockObjectWithClassName)
    {
        $objectTypeString = get_class($value);
        $mockClassUtil = new MockClassUtil();
        $isMockObject = $mockClassUtil->isMockClass($objectTypeString);
        if ($isMockObject) {
            // This object must support MockTrait which includes this method.
            /* @var MockClass $mockObj */
            $mockObj = $value->__getUnitTestGeneratorMockInstance();
            if ($replaceMockObjectWithClassName){
                $objectName = $mockObj->getMockObjectName();
                $result = "$" . $objectName;
            } else {
                $result = $mockObj->__toString();
            }
        } else {
            $result = "( $objectTypeString ) object";

            if ($value instanceof \JsonSerializable) {
                $jsonEncoded = json_encode($value);
                $result .= " value ( $jsonEncoded )";
            }
        }

        return $result;
    }

}
