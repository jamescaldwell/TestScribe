<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

/**
 * Class ValueFormatter
 * @package Box\TestScribe
 *
 * Get the human readable representation of a value.
 *
 * @var ValueTransformer | ValueFormatterHelper
 */
class ValueFormatter
{
    /** @var ValueTransformer */
    private $valueTransformer;

    /** @var ValueFormatterHelper */
    private $valueFormatterHelper;

    /**
     * @param \Box\TestScribe\Utils\ValueTransformer     $valueTransformer
     * @param \Box\TestScribe\Utils\ValueFormatterHelper $valueFormatterHelper
     */
    function __construct(
        ValueTransformer $valueTransformer,
        ValueFormatterHelper $valueFormatterHelper
    )
    {
        $this->valueTransformer = $valueTransformer;
        $this->valueFormatterHelper = $valueFormatterHelper;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function getReadableFormat($value)
    {
        $transformedValue = $this->valueTransformer->translateObjectsAndResourceToString(
            $value
        );

        $result = $this->valueFormatterHelper->getReadableFormatFromSimpleValue(
            $transformedValue
        );

        return $result;
    }

}
