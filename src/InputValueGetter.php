<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Input\StringToInputValueConverter;
use Box\TestScribe\PHPDoc\IPhpDoc;
use Box\TestScribe\Utils\ClassNameUtil;

/**
 * Class InputValueGetter
 * @package Box\TestScribe
 *
 * Need to make this class lazy since it depends indirectly on MockClassFactory
 * which depends on it indirectly causing a circular reference.
 * This class is not needed until later when a mocked method is invoked.
 * @Injectable(lazy=true)
 *
 * Gather user input for a value.
 */
class InputValueGetter
{
    /**
     * @var StringToInputValueConverter
     */
    private $stringToInputValueConverter;

    /**
     * @var InputWithHistory
     */
    private $inputWithHistory;

    /**
     * @param \Box\TestScribe\Input\StringToInputValueConverter $stringToInputValueConverter
     * @param \Box\TestScribe\InputWithHistory            $inputWithHistory
     */
    function __construct(
        StringToInputValueConverter $stringToInputValueConverter,
        InputWithHistory $inputWithHistory
    )
    {
        $this->stringToInputValueConverter = $stringToInputValueConverter;
        $this->inputWithHistory = $inputWithHistory;
    }

    /**
     *
     * @param \Box\TestScribe\PHPDoc\IPhpDoc $typeInfo
     * @param string                                   $subject
     *   The description of the target that is to receive the value
     * @param string                                   $className '' if the class under test
     * @param string                                   $methodName
     * @param string                                   $paramName
     *
     * @return \Box\TestScribe\Input\InputValue
     */
    public function get(
        IPhpDoc $typeInfo,
        $subject,
        $className,
        $methodName,
        $paramName
    )
    {
        $isClass = $typeInfo->isClass();
        if ($isClass) {
            $className = $typeInfo->getRepresentation();

            // Automatically mock the class in this simple case for convenience
            // by automatically generating an expression that uses this className.
            // The assumption is that that class name returned here is a 
            // fully qualified name which starts with '\'.
            $expression =
                ClassNameUtil::getNormalizedFullyQualifiedClassName($className);
        } else if ($typeInfo->isVoid()) {
            $expression = 'void';
        } else {
            // @TODO (ryang 1/9/15) : allow users to retry when they make a typo.
            // @TODO (ryang 1/9/15) : validate against the type
            $typeString = $typeInfo->getRepresentation();
            $subjectWithTypeInfo = "$subject, type ( $typeString )";

            $expression = $this->inputWithHistory->getInputValue(
                $subjectWithTypeInfo, 
                $className,
                $methodName,
                $paramName
            );
        }

        $inputValue = $this->stringToInputValueConverter->getValue($expression);

        return $inputValue;
    }
}
