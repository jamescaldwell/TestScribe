<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

/**
 * Custom var_export wrapper.
 *
 * Customize the output of the var_export call.
 *
 * Class VarExporter
 * @package Box\TestScribe
 */
class VarExporter
{
    /**
     * Export a variable using var_export and customize the output.
     *
     * Spaces can be added to each line without changing the value of
     * the result string.
     *
     * @param mixed $variable
     *
     * @return string
     */
    public function exportVariable($variable)
    {
        $regularExported = var_export($variable, true);

        if (is_string($variable)) {
            $exported = $this->exportString($regularExported);
        } else {
            $exported = $regularExported;
        }

        return $exported;
    }

    /**
     * Given a var_exported string, replace literal return character
     * with ' . "\n" .\n'.
     *
     * e.g.
     *
     * 'a
     * b'
     * becomes
     * 'a' . "\n" .
     * 'b'
     *
     * This is done so that additional spaces can be freely added in the front
     * to correct indentations.
     *
     * @param string $strVarExport
     *
     * @return string
     */
    private function exportString($strVarExport)
    {
        $replacementStr = "'" . ' . "\\n" .' . "\n" . "'";
        $transformed = str_replace("\n", $replacementStr, $strVarExport);

        return $transformed;
    }
}
