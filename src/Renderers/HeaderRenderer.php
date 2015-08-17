<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\ClassInfo\PhpClassName;

/**
 * Class HeaderRenderer
 * @package Box\TestScribe
 *
 * Generate the result test class header.
 */
class HeaderRenderer
{
    /**
     * @param PhpClassName $outPhpClassName
     *
     * @return string
     */
    public function renderClassHeader(
        PhpClassName $outPhpClassName
    )
    {
        $classNamespace = $outPhpClassName->getNameSpace();
        if ($classNamespace != '') {
            $namespaceStatement = "namespace $classNamespace;";
        } else {
            $namespaceStatement = '';
        }
        $testClassName = $outPhpClassName->getClassName();

        $headerStatements = <<<TAG
<?php
$namespaceStatement

/**
 * Generated by TestScribe.
 */
class $testClassName extends \\PHPUnit_Framework_TestCase

TAG;

        return $headerStatements;
    }
}
