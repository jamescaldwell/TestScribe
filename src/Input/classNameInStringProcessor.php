<?php
namespace Box\TestScribe\Input;

use Box\TestScribe\Mock\FullMockObjectFactory;

/**
 * Class classNameInStringProcessor
 *
 * Pre-process a PHP variable definition string with PHP syntax
 * looking for class names.
 *
 * @package Box\TestScribe
 * @var FullMockObjectFactory
 */
class classNameInStringProcessor
{
    // Gather the mock objects created when the corresponding
    // class names are detected.
    private $mocks = [];

    /** @var FullMockObjectFactory */
    private $fullMockObjectFactory;

    /**
     * @param \Box\TestScribe\Mock\FullMockObjectFactory $fullMockObjectFactory
     */
    function __construct(
        FullMockObjectFactory $fullMockObjectFactory
    )
    {
        $this->fullMockObjectFactory = $fullMockObjectFactory;
    }

    /**
     * @param string $str a PHP variable definition string with PHP syntax.
     *
     * @return \Box\TestScribe\Input\ExpressionWithMocks
     */
    public function process($str)
    {
        // Make sure to reset this member variable
        // because this class is a singleton.
        // @TODO (ryang 12/31/14) : investigate why using a local variable
        // and closure doesn't work.
        $this->mocks = [];
        
        $callback = function ($matches) {
            $className = $matches[0];
            $mockClass = $this->fullMockObjectFactory->createMockObject($className);
            $replacementStr = "$" . $mockClass->getMockObjectName();
            $this->mocks[] = $mockClass;
            return $replacementStr;
        };

        // Need to escape '\' multiple times to make regex work.
        // The first \ is to escape PHP string '\' to allow it to be passed to regex engine.
        // preg_quote doesn't work since it escapes ^ incorrectly.

        // Test if the input is a string by testing if it starts with
        // a ' or " character.
        $isString = preg_match('#^\\s*[\'"]#', $str);
        if ($isString === 1) {
            $rc = new ExpressionWithMocks($str, []);
            return $rc;
        }

        // Match an identifier that starts with a '\' character
        // followed by letters or digits or '\'
        // and check if it is not part of a string
        // by looking ahead to see if it sees a ' or " character
        // or encounters a ',' character first.
        // e.g. [\Foo, "a"] should detect \Foo
        // e.g. ["\Foo"] should not detect \Foo
        // e.g. ["a\"b"] should not detect \"
        $regExpressionPattern = '#\\\[a-zA-Z0-9_\\\]+(?![^,]*[\'"])#';
        $replacedStr = preg_replace_callback(
            $regExpressionPattern,
            $callback,
            $str
        );
        if ($replacedStr === null) {
            throw new \RuntimeException("Failed to replace class name references in the input string.");
        }

        $rc = new ExpressionWithMocks($replacedStr, $this->mocks);

        return $rc;
    }
}
