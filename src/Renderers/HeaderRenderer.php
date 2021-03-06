<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\ClassInfo\PhpClassName;
use Box\TestScribe\Config\GlobalComputedConfig;

/**
 * Class HeaderRenderer
 * @package Box\TestScribe
 *
 * Generate the result test class header.
 *
 * @var GlobalComputedConfig
 */
class HeaderRenderer
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
    }

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
        $testBaseClassName = $this->globalComputedConfig->getTestBaseClassName();

        $headerStatements = <<<TAG
<?php
$namespaceStatement

/**
 * Generated by TestScribe.
 */
class $testClassName extends $testBaseClassName

TAG;

        return $headerStatements;
    }
}
