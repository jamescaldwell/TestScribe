<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\Config\GlobalComputedConfig;

/**
 * Class CallOriginatorChecker
 * @package Box\TestScribe\Utils
 */
class CallOriginatorChecker
{
    /**
     * @var GlobalComputedConfig
     */
    private $globalComputedConfig;

    /**
     * @var CallInformationCollector
     */
    private $callInformationCollector;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig           $globalComputedConfig
     * @param \Box\TestScribe\Utils\CallInformationCollector $callInformationCollector
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        CallInformationCollector $callInformationCollector
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->callInformationCollector = $callInformationCollector;
    }

    /**
     * If the call of the given frame index is a call from the class being tested.
     *
     * @param int $distanceFromThisCall
     *   e.g.
     *   bar calls foo, foo calls this method
     *   To check about foo, specify 1.
     *   To check about bar, specify 2.
     *
     * @return bool
     * @throws \Box\TestScribe\GeneratorException
     */
    public function isCallFromTheClassBeingTested($distanceFromThisCall)
    {
        // The file path should be an absolute path.
        $inputSourceFilePath = $this->globalComputedConfig->getInSourceFile();
        
        // Add one to the distance to take into consideration of the 
        // additional frame between this call and 
        // $this->callInformationCollector->getCallerInfoAt
        $callInfo = $this->callInformationCollector->getCallerInfoAt($distanceFromThisCall + 1);
        $filePathOfTheCaller = $callInfo->getFileName();
        $isImmediateCall = ($inputSourceFilePath === $filePathOfTheCaller);

        return $isImmediateCall;
    }
}
