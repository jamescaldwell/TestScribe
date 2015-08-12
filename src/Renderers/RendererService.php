<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\ExecutionResult;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Output;
use Box\TestScribe\Utils\DirectoryUtil;


/**
 * Class RendererService
 *
 * Generate the test code.
 */
class RendererService
{
    /**
     * @var Output
     */
    private $out;

    /**
     * @var \Box\TestScribe\Config\GlobalComputedConfig
     */
    private $computedConfig;

    /**
     * @var MethodRenderer
     */
    private $methodRenderer;

    /**
     * @var HeaderRenderer
     */
    private $headerRenderer;
    
    /** @var  DirectoryUtil */
    private $directoryUtil;

    /**
     * @param \Box\TestScribe\Output                   $out
     * @param \Box\TestScribe\Config\GlobalComputedConfig     $computedConfig
     * @param \Box\TestScribe\Renderers\MethodRenderer $methodRenderer
     * @param \Box\TestScribe\Renderers\HeaderRenderer $headerRenderer
     * @param \Box\TestScribe\Utils\DirectoryUtil      $directoryUtil
     */
    function __construct(
        Output $out,
        GlobalComputedConfig $computedConfig,
        MethodRenderer $methodRenderer,
        HeaderRenderer $headerRenderer,
        DirectoryUtil $directoryUtil
    )
    {
        $this->out = $out;
        $this->computedConfig = $computedConfig;
        $this->methodRenderer = $methodRenderer;
        $this->headerRenderer = $headerRenderer;
        $this->directoryUtil = $directoryUtil;
    }

    /**
     * Generate the test code in the output file.
     *
     * @param ExecutionResult                        $executionResult
     *
     * @return void
     */
    public function render(
        ExecutionResult $executionResult
    )
    {
        $file = $this->computedConfig->getOutSourceFile();

        $this->deleteExistingDestinationFileWhenNeeded($file);

        $result = $this->methodRenderer->renderMethod($executionResult);

        if (!file_exists($file)) {
            $config = $this->computedConfig;

            $header = $this->headerRenderer->renderClassHeader(
                $config->getOutPhpClassName()
            );

            // @TODO (ryang 8/20/14) : move rendering logic to the render class.
            // @TODO (ryang 8/21/14) : make it configurable which mocking framework to use.
            $result = <<<TAG
$header{
    use \\Shmock\\Shmockers;

$result
}

TAG;
        }
        $this->insertIntoFile($file, '}', $result, false);
        $msg = "\nAdded a test to ( $file ).\n";
        $this->out->writeln($msg);
    }

    /**
     * Delete the existing destination file if it exists
     * and the command line option is specified to overwrite it.
     *
     * @param string $file
     */
    private function deleteExistingDestinationFileWhenNeeded($file)
    {
        if (file_exists($file) && $this->computedConfig->isOverwriteExistingDestinationFile()) {
            unlink($file);
        }
    }

    /**
     * Insert $text into file at the last occurrence of the marker.
     * if $file doesnt exist then $file is created and $text added to $file
     *
     * @param  string $file
     * @param  string $marker
     * @param  string $text
     *
     * @return void
     */
    private function insertIntoFile($file, $marker, $text)
    {
        if (!file_exists($file)) {
            $this->directoryUtil->createDirectoriesWhenNeededForFile($file);
            file_put_contents($file, $text);
        } else {
            // Pull the file contents, get the last occurrence of $marker.
            $contents = file_get_contents($file);
            $pos = strrpos($contents, $marker);

            // add before the last occurrence of marker our $text.
            // To achieve this we replace $marker with $text and append $marker again
            $new_contents = substr_replace(
                $contents,
                "\n" . $text . "\n" . $marker . "\n",
                $pos,
                strlen($text) + strlen($contents)
            );

            file_put_contents($file, $new_contents);
        }
    }
}
