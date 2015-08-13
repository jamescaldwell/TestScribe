<?php

namespace Box\TestScribe\Config;

/**
 */
class PathUtil 
{
    /**
      * Get the complete path under the given root directory.
      *
      * @param string $rootDir
      * @param string $sourceFilePathRelativeToSourceRoot
      *
      * @return string
      *   the path should not end with '/'.
      */
     public static function getPathUnderRoot(
         $rootDir,
         $sourceFilePathRelativeToSourceRoot
     )
     {
         if ($sourceFilePathRelativeToSourceRoot) {
             // In this case the relative path should start with a DIRECTORY_SEPARATOR.
             assert($sourceFilePathRelativeToSourceRoot[0] === DIRECTORY_SEPARATOR);
             $outPath = $rootDir . $sourceFilePathRelativeToSourceRoot;
         } else {
             $outPath = $rootDir;
         }

         return $outPath;
     }
}
