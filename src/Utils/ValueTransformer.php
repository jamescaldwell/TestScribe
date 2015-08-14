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
      *
      * @return mixed
      *
      * Recursively translate any object or resource contained in this value to its string representation.
      */
     public function translateObjectsAndResourceToString($value)
     {
         if (is_object($value)) {
             $result = $this->translateObjectToString($value);

             return $result;
         }

         if (is_array($value)) {
             $simpleArray = [];
             foreach ($value as $index => $element) {
                 $simpleArray[$index] = $this->translateObjectsAndResourceToString($element);
             }

             return $simpleArray;
         }

         if (is_resource($value)){
             $type = get_resource_type($value);
             $result = "resource ( $type )";

             return $result;

         }

         return $value;
     }

     /**
      * @param object $value
      *
      * @return string
      */
     private function translateObjectToString($value)
     {
         $objectTypeString = get_class($value);
         $mockClassUtil = new MockClassUtil();
         $isMockObject = $mockClassUtil->isMockClass($objectTypeString);
         if ($isMockObject) {
             // This object must support MockTrait which includes this method.
             /* @var MockClass $mockObj */
             $mockObj = $value->__getUnitTestGeneratorMockInstance();
             $result = $mockObj->__toString();
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
