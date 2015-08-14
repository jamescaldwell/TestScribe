<?php


namespace Box\TestScribe\_fixture;

use Box\TestScribe\FullMockObjectFactory;
use Box\TestScribe\MockClassLoader;
use Box\TestScribe\MockObjectFactory;
use Box\TestScribe\Output;
use Box\TestScribe\StringToInputValueConverter;
use Box\TestScribe\Utils\ReflectionUtil;
use DI\Container;
use DI\ContainerBuilder;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Create objects from a container
 */
class ObjectFactory
{
    /** @var Container */
    private $container;

    /**
     *
     */
    function __construct()
    {
        // Initialize dependency injection framework.
        $builder = new ContainerBuilder();
        $container = $builder->build();
        $nullOutput = new NullOutput();
        $output = new Output($nullOutput);
        $container->set('Box\\TestScribe\\Output', $output);

        $this->container = $container;
    }

    /**
     * @param string $className
     *
     * @return object
     * @throws \DI\NotFoundException
     */
    function getClassInstance($className)
    {
        $obj = $this->container->get($className);

        return $obj;
    }

    /**
     * @return \Box\TestScribe\Utils\ReflectionUtil
     */
    public function getReflectionUtil()
    {
        /** @var ReflectionUtil $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\Utils\\ReflectionUtil');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\StringToInputValueConverter
     */
    public function getStringToInputValueConverter()
    {
        /** @var \Box\TestScribe\Input\StringToInputValueConverter $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\StringToInputValueConverter');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\MockClassLoader
     */
    public function getMockClassLoader()
    {
        /** @var MockClassLoader $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\MockClassLoader');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\MockObjectFactory
     */
    public function getMockObjectFactory()
    {
        /** @var MockObjectFactory $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\MockObjectFactory');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\FullMockObjectFactory
     */
    public function getFullMockObjectFactory()
    {
        /** @var FullMockObjectFactory $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\FullMockObjectFactory');

        return $obj;
    }
}
