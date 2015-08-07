<?php

namespace Box\TestScribe\Config;

use Box\TestScribe\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\FunctionWrappers\FunctionWrapper;
use Box\TestScribe\GeneratorException;
use Symfony\Component\Console\Input\InputInterface;


/**
 * @var FileFunctionWrapper|FunctionWrapper
 */
class ConfigHelper
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var FunctionWrapper */
    private $functionWrapper;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\FunctionWrappers\FunctionWrapper     $functionWrapper
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper,
        FunctionWrapper $functionWrapper
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->functionWrapper = $functionWrapper;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return void
     * @throws \Box\TestScribe\GeneratorException
     */
    public function loadBootstrapFile(InputInterface $input)
    {
        $bootstrapFile = $input->getOption(CmdOption::BOOT_STRAP_FILE_PATH_OPTION);
        if ($bootstrapFile) {
            if (!$this->fileFunctionWrapper->file_exists($bootstrapFile)) {
                $errMsg = "Bootstrap file ( $bootstrapFile ) doesn't exist.";
                throw new GeneratorException($errMsg);
            }

            $this->functionWrapper->includeFile($bootstrapFile);
        }
    }
}
