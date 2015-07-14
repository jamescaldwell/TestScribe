<?php
namespace Box\TestScribe\Tests;

use Box\TestScribe\_fixture\_input\TestMethodsProvider;
use Box\TestScribe\_fixture\Directory;
use Box\TestScribe\_fixture\TestCreator;
use Box\TestScribe\GlobalFunction;
use Box\TestScribe\Utils\DirectoryUtil;

/**
 * Generic functional tests
 */
class GeneratorFunctionalTest extends \PHPUnit_Framework_TestCase
{
    const FUNCTIONAL_TEST_TEMP_DIR = 'tmp';
    const GENERATED_TEST_FILE_SUFFIX = 'GenTest.php';

    private $tempDir;

    /**
     * @return void
     */
    protected function setUp()
    {
        $inputDir = Directory::getInputDataDir();
        $this->tempDir =
            $inputDir . DIRECTORY_SEPARATOR . self::FUNCTIONAL_TEST_TEMP_DIR;
        $dirUtil = new DirectoryUtil(new GlobalFunction());
        $dirUtil->createDirectoriesWhenNeeded($this->tempDir);
        $this->cleanUpFunctionalTestTempDir();
    }

    /**
     * @return void
     */
    protected function tearDown()
    {
        $this->cleanUpFunctionalTestTempDir();
    }

    /**
     * @return void
     */
    private function cleanUpFunctionalTestTempDir()
    {
        array_map('unlink', glob("{$this->tempDir}/*.php"));
    }

    /**
     * @return array
     */
    public function TestMethodsProvider()
    {
        $methods = TestMethodsProvider::getTestMethods();

        return $methods;
    }

    /**
     * Functional test of test generator.
     *
     * @dataProvider TestMethodsProvider
     *
     * @param string $className
     * @param string $methodName
     * @param string $answerFileName
     *
     * @return void
     */
    public function testGeneratorCreatesACorrectTestFile($className, $methodName, $answerFileName)
    {
        $this->verifyCorrectTestFileIsGenerated(
            $className,
            $methodName,
            $answerFileName
        );
    }

    /**
     * @return void
     */
    public function testHistoryFileAccess()
    {
        $tempDir = $this->tempDir;
        $historyDir = "$tempDir/test_generator/history/";
        $historyFile = "$historyDir/StaticCalculator.yaml";
        if (is_dir($historyDir)) {
            // Clean up previously generated history file.
            unlink($historyFile);
        }
        $this->verifyCorrectTestFileIsGenerated(
            'StaticCalculator',
            'add',
            'calculatorAdd'
        );
        $this->assertFileExists($historyFile, 'The history file is not generated.');
        $generatedTestFile = "$tempDir/StaticCalculator" . self::GENERATED_TEST_FILE_SUFFIX;
        unlink($generatedTestFile);
        // take answers from the history file previously generated.
        $this->verifyCorrectTestFileIsGenerated(
            'StaticCalculator',
            'add',
            'calculatorAddHistory'
        );
    }

    /**
     * Functional test of test generator.
     *
     * @param string $className
     * @param string $methodName
     * @param string $answerFileName
     *
     * @return void
     */
    private function verifyCorrectTestFileIsGenerated($className, $methodName, $answerFileName)
    {
        $tempDir = $this->tempDir;
        $outputFilePath = "$tempDir/{$className}" . self::GENERATED_TEST_FILE_SUFFIX;
        TestCreator::createTest($className, $methodName, $tempDir, $answerFileName);
        $expectedFilePath = Directory::getExpectedTestsDir() .
            '/_input/' . $className . self::GENERATED_TEST_FILE_SUFFIX;
        
        $this->assertFileEquals(
            $expectedFilePath,
            $outputFilePath
        );
    }
}
