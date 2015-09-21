<?php
/**
 *
 */

namespace Box\TestScribe\InputHistory;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\FunctionWrappers\GlobalFunction;
use Box\TestScribe\Utils\FileUtil;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

/**
 * Class InputHistoryPersistence
 * @package Box\TestScribe
 *
 * @var GlobalComputedConfig|FileUtil|GlobalFunction
 */
class InputHistoryPersistence
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var FileUtil */
    private $fileUtil;

    /** @var GlobalFunction */
    private $globalFunction;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\Utils\FileUtil $fileUtil
     * @param \Box\TestScribe\FunctionWrappers\GlobalFunction $globalFunction
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        FileUtil $fileUtil,
        GlobalFunction $globalFunction
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->fileUtil = $fileUtil;
        $this->globalFunction = $globalFunction;
    }


    /**
     * @return \Box\TestScribe\InputHistory\InputHistoryData
     */
    public function loadHistory()
    {
        $data = new InputHistoryData();

        $historyFilePath = $this->globalComputedConfig->getHistoryFile();
        if ($this->globalFunction->file_exists($historyFilePath)) {
            $yamlString = $this->globalFunction->file_get_contents($historyFilePath);
            $parser = new Parser();
            $dataArray = $parser->parse($yamlString);
            $data->setData($dataArray);
        }

        return $data;
    }

    /**
     * @param \Box\TestScribe\InputHistory\InputHistoryData $historyData
     *
     * @return void
     */
    public function saveHistory(
        InputHistoryData $historyData
    )
    {
        $dataInYaml = $this->convertToYamlString($historyData);
        $this->writeDataStringToFile($dataInYaml);
    }

    /**
     * @param \Box\TestScribe\InputHistory\InputHistoryData $historyData
     *
     * @return string
     */
    private function convertToYamlString(
        InputHistoryData $historyData
    )
    {
        $dumper = new Dumper();
        $data = $historyData->getData();
        $dataInYaml = $dumper->dump($data, 2);

        return $dataInYaml;
    }

    /**
     * @param string $dataString
     *
     * @return void
     */
    private function writeDataStringToFile(
        $dataString
    )
    {
        $historyFilePath = $this->globalComputedConfig->getHistoryFile();
        if (!$this->globalFunction->file_exists($historyFilePath)) {
            $this->fileUtil->createDirectoriesWhenNeededForFile($historyFilePath);
        }
        $this->globalFunction->file_put_contents($historyFilePath, $dataString);
    }
}
