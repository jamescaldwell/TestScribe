<?php


namespace Box\TestScribe\Utils;

use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;


/**
 * @var FileFunctionWrapper
 */
class YamlUtil
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
    }

    /**
     * @param string $path
     *
     * @return mixed
     */
    public function loadYamlFile($path)
    {
        $yamlString = $this->fileFunctionWrapper->file_get_all_contents($path);
        $parser = new Parser();
        $data = $parser->parse($yamlString);

        return $data;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public function dumpToString($value)
    {
        $dumper = new Dumper();
        $dumper->setIndentation(2);
        $yamlString = $dumper->dump($value, 5);

        return $yamlString;
    }
}
