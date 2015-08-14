<?php
/**
 *
 */

namespace Box\TestScribe\Mock;

use Box\TestScribe\Output;

/**
 * Create and load mock classes for static invocations.
 *
 * @var MockClassFactory | Output | ClassBuilderStatic
 */
class StaticMockClassFactory
{
    /** @var MockClassFactory */
    private $mockClassFactory;

    /** @var Output */
    private $output;

    /** @var ClassBuilderStatic */
    private $classBuilderStatic;

    /**
     * @param \Box\TestScribe\Mock\MockClassFactory   $mockClassFactory
     * @param \Box\TestScribe\Output             $output
     * @param \Box\TestScribe\Mock\ClassBuilderStatic $classBuilderStatic
     */
    function __construct(
        MockClassFactory $mockClassFactory,
        Output $output,
        ClassBuilderStatic $classBuilderStatic
    )
    {
        $this->mockClassFactory = $mockClassFactory;
        $this->output = $output;
        $this->classBuilderStatic = $classBuilderStatic;
    }

    /**
     * Create and load the definition of a mock class.
     *
     * @param string $className
     *
     * @return \Box\TestScribe\Mock\MockClass
     * @throws \DI\NotFoundException
     */
    public function createAndLoadStaticMockClass(
        $className
    )
    {
        $mockClass = $this->mockClassFactory->create(
            $className,
            true,
            ''
        );

        $mockObjectName = $mockClass->getMockObjectName();
        $this->classBuilderStatic->create($mockClass);

        // @TODO (ryang 5/27/15) : display line number
        $msg = "Mocked ( $className ) id ( $mockObjectName ) for static methods invocation.\n";
        $this->output->writeln($msg);

        return $mockClass;
    }
}
