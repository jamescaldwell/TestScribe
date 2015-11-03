<?php
namespace Box\TestScribe\Mock;

use Box\TestScribe\ClassInfo\PhpClass;
use Box\TestScribe\ClassInfo\PhpClassName;

/**
 * Class MockClassFactory
 * @package Box\TestScribe
 *
 * @var MockClassService | MockObjectNameMgr | MockMgr
 */
class MockClassFactory
{
    /** @var MockClassService */
    private $mockClassService;

    /** @var MockObjectNameMgr */
    private $mockObjectNameMgr;

    /** @var MockMgr */
    private $mockMgr;

    /**
     * @param \Box\TestScribe\Mock\MockClassService  $mockClassService
     * @param \Box\TestScribe\Mock\MockObjectNameMgr $mockObjectNameMgr
     * @param \Box\TestScribe\Mock\MockMgr           $mockMgr
     */
    function __construct(
        MockClassService $mockClassService,
        MockObjectNameMgr $mockObjectNameMgr,
        MockMgr $mockMgr
    )
    {
        $this->mockClassService = $mockClassService;
        $this->mockObjectNameMgr = $mockObjectNameMgr;
        $this->mockMgr = $mockMgr;
    }

    /**
     * @param string $className
     * @param bool   $isStatic
     * @param string $nameOfTheMethodToPassThrough
     *   If not empty string, it tells this instance to pass calls to
     *   this method to the real object of the class being mocked
     *   and continue to mock other methods.
     *   If it is empty, it tells this instance to mock all methods.
     *
     * @return \Box\TestScribe\Mock\MockClass
     * @throws \DI\NotFoundException
     */
    public function create(
        $className,
        $isStatic,
        $nameOfTheMethodToPassThrough
    )
    {
        $phpClassName = new PhpClassName($className);
        $simpleClassName = $phpClassName->getClassName();
        $mockObjectName = $this->mockObjectNameMgr->getMockObjectName($simpleClassName);

        $phpClass = new PhpClass($phpClassName);

        $mock = new MockClass(
            $this->mockClassService,
            $phpClass,
            $isStatic,
            $nameOfTheMethodToPassThrough,
            $mockObjectName
        );

        $this->mockMgr->addMock($mock);

        return $mock;
    }
}
