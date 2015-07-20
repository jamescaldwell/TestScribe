<?php

namespace Box\TestScribe\_fixture;

/**
 */
class TestCreator
{
    /**
      * Generate a test for the given method at the given location using an answer file.
      *
      * @param string $className
      * @param string $methodName
      * @param string $testRootDir
      * @param string $answerFileName
      *
      * @return void
      */
     static function createTest($className, $methodName, $testRootDir, $answerFileName)
     {
         // @TODO (ryang 11/12/14) : use DIRECTORY_SEPARATOR consistently to make the test platform independent.

         // We use the -o overwrite flag to overwrite any output file which may be there.
         // Thus we don't need to clean up the generated files.
         $projectRootDir = Directory::getProjectRoot();
         $fixtureDir = Directory::getFixtureDir();
         $inputDir = Directory::getInputDataDir();

         $cmd = "cat $inputDir/$answerFileName.txt | "
             . "php $projectRootDir/bin/test_scribe.php generate-test "
             . " $methodName $inputDir/$className.php "
             . " --test-source-root=$testRootDir "
             . " --bootstrap=$fixtureDir/bootstrapForTest.php -o";

         // Execute the command in a shell.
         // Without assigning the expression result to a local variable first
         // Intellij will warn about not using the result of an expression.
         /** @noinspection PhpUnusedLocalVariableInspection */

         $out = `$cmd`;
     }
}
