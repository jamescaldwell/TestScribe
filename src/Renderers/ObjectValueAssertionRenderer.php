<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Utils\ArrayUtil;
use Box\TestScribe\Utils\MockClassUtil;

/**
 * Generate code that validates a given object.
 */
class ObjectValueAssertionRenderer
{
    /**
     * @var MockClassUtil
     */
    private $mockClassUtil;

    /**
     * @param \Box\TestScribe\Utils\MockClassUtil $mockClassUtil
     */
    function __construct(
        MockClassUtil $mockClassUtil
    )
    {
        $this->mockClassUtil = $mockClassUtil;
    }

    /**
     * Generate assertions of an object.
     *
     * @param string  $variableName name without '$' prefix
     * @param \object $value
     *
     * @return string
     */
    public function generateForAnObject($variableName, $value)
    {
        $objectTypeString = get_class($value);
        $isMockObject = $this->mockClassUtil->isMockClass($objectTypeString);
        $typeCheckStatement = $this->renderObjectTypeAssertion(
            $isMockObject,
            $variableName,
            $value
        );

        if ($isMockObject) {
            // Calling methods on mocked object at the rendering phase can 
            // confuse users where the call comes from.
            // Don't call json_encode() method here.

            // @TODO (ryang 12/19/14) : re-evaluate when we start supporting non shmock based mocking
            // frameworks

            $valueCheckStatement = '';
        } else {
            $valueCheckStatement = $this->renderObjectValueAssertion(
                $variableName,
                $value
            );
        }
        $statements = ArrayUtil::joinNonEmptyStringsWithNewLine(
            [$typeCheckStatement , $valueCheckStatement],
            2
        );

        return $statements;
    }

    /**
     * Generate statements to verify the object has the correct type.
     *
     * @param bool    $isMockObject
     * @param string  $variableName
     * @param \object $value
     *
     * @return string
     */
    private function renderObjectTypeAssertion(
        $isMockObject,
        $variableName,
        $value
    )
    {
        if ($isMockObject) {
            //Special case mock objects since the mock objects used in the 
            //test generation and the test runs are different.

            // Assume the parent class of the proxied object is the class
            // it mocks.
            $objectTypeString = get_parent_class($value);
        } else {
            $objectTypeString = get_class($value);
        }

        $objectTypeStringAsString = var_export($objectTypeString, true);
        $failureMsg = "Variable ( $variableName ) doesn't have the expected type.";
        $failureMsgAsString = var_export($failureMsg, true);

        $statements = <<<TAG
\$this->assertInstanceOf(
    $objectTypeStringAsString,
    \$$variableName,
    $failureMsgAsString
);
TAG;

        return $statements;
    }

    /**
     * Generate statements to verify the object has the correct value.
     *
     * @param string  $variableName
     * @param \object $value
     *
     * @return string
     */
    private function renderObjectValueAssertion(
        $variableName,
        $value
    )
    {
        // @TODO (ryang 12/18/14) : Consider using 
        // JSON_PRETTY_PRINT option to make the JSON representation more readable.
        $objectValueInJSON = json_encode($value);
        $objectValueInJSONAsString = var_export($objectValueInJSON, true);
        $valueCheckFailureMsg = "Variable ( $variableName ) doesn't have the expected value.";
        $valueCheckFailureMsgAsString = var_export($valueCheckFailureMsg, true);
        // @TODO (ryang 12/19/14) : fall back to __toString method, print_r method
        // when the object doesn't implement JsonSerializable interface or 
        // json_encode returns '{}'.

        $statements = <<<TAG
\$this->assertSame(
    $objectValueInJSONAsString,
    json_encode(\$$variableName),
    $valueCheckFailureMsgAsString
);

TAG;

        return $statements;
    }
}
