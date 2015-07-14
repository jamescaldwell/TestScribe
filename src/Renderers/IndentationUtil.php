<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

/**
 * Class IndentationUtil
 * @package Box\TestScribe\Renderers
 */
class IndentationUtil
{
    /**
     * @param int    $blocks 
     *  number of indentation blocks to add to the beginning of a line.
     * @param string $text
     *  The text block that need to be shifted.
     *
     * @return string
     *  A new text block with each line shifted by the specified number of blocks.
     */
    public function indent($blocks, $text)
    {
        if (empty($text)) {
            return '';
        }
        
        $spacesToShift = 4 * $blocks;
        $spaces = str_repeat(' ', $spacesToShift);

        $lines = explode("\n", $text);
        $shiftedLines = [];
        foreach ($lines as $aLine) {
            if ($aLine) {
                $shiftedLine = $spaces . $aLine;    
            } else {
                $shiftedLine = $aLine;
            }
            
            $shiftedLines[] = $shiftedLine;
        }
        $shiftedText = implode("\n", $shiftedLines);
        
        return $shiftedText;
    }
}
