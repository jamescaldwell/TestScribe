<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Create a mock object instance that is fully mocked.
 *
 * Class MockObjectFactory
 * @package Box\TestScribe
 *
 * @var MockClassLoader | MockObjectFactory|Output
 */
class FullMockObjectFactory
{
    /** @var MockClassLoader */
    private $mockClassLoader;

    /** @var MockObjectFactory */
    private $mockObjectFactory;

    /** @var Output */
    private $output;

    /**
     * @param \Box\TestScribe\MockClassLoader   $mockClassLoader
     * @param \Box\TestScribe\MockObjectFactory $mockObjectFactory
     * @param \Box\TestScribe\Output            $output
     */
    function __construct(
        MockClassLoader $mockClassLoader,
        MockObjectFactory $mockObjectFactory,
        Output $output
    )
    {
        $this->mockClassLoader = $mockClassLoader;
        $this->mockObjectFactory = $mockObjectFactory;
        $this->output = $output;
    }

    /**
     * @param string $className
     *
     * @return \Box\TestScribe\Mock\MockClass
     */
    public function createMockObject(
        $className
    )
    {
        $mockClass = $this->mockClassLoader->createAndLoadMockClass(
            $className,
            ''
        );

        // The fully mocked objects are assumed to have the original
        // constructors overwritten to not call the original constructors.
        // Thus the arguments to the original constructors are ignored.
        $mockObj = $this->mockObjectFactory->createMockObjectFromMockClass(
            $mockClass,
            []
        );

        $mockClass->setMockedDynamicClassObj($mockObj);

        // Only show the mock message when full mocking is requested.
        // Since in most cases when partial mocking is not needed
        // the class under test won't be mocked.
        // Showing this message actually can cause confusion.
        $fullName = $mockClass->getClassNameBeingMocked();
        $mockObjectName = $mockClass->getMockObjectName();

        // @TODO (ryang 5/27/15) : display line number
        $msg = "Mocked ( $fullName ) id ( $mockObjectName ).\n";
        $this->output->writeln($msg);

        return $mockClass;
    }
}
