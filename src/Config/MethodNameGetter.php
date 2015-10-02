<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\CLI\CmdOption;
use Symfony\Component\Console\Input\InputInterface;

/**
 * @var MethodNameSelector
 */
class MethodNameGetter
{
    /** @var MethodNameSelector */
    private $methodNameSelector;

    /**
     * @param \Box\TestScribe\Config\MethodNameSelector $methodNameSelector
     */
    function __construct(
        MethodNameSelector $methodNameSelector
    )
    {
        $this->methodNameSelector = $methodNameSelector;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param string $fullClassName
     *
     * @return string
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function getTestMethodName(
        InputInterface $input,
        $fullClassName
    )
    {
        $methodName = (string) $input->getArgument(CmdOption::METHOD_NAME_KEY);
        if($methodName === '') {
            $methodName = $this->methodNameSelector->selectTestMethodName($fullClassName);
        }

        return $methodName;
    }
}
