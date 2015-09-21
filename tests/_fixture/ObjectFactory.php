<?php


namespace Box\TestScribe\_fixture;

use Box\TestScribe\Mock\MockClassLoader;
use Box\TestScribe\Output;
use Box\TestScribe\Utils\FileUtil;
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
     * @return \Box\TestScribe\Input\StringToInputValueConverter
     */
    public function getStringToInputValueConverter()
    {
        /** @var \Box\TestScribe\Input\\Box\TestScribe\Input\StringToInputValueConverter $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\Input\\StringToInputValueConverter');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\Mock\MockClassLoader
     */
    public function getMockClassLoader()
    {
        /** @var MockClassLoader $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\Mock\\MockClassLoader');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\Mock\MockObjectFactory
     */
    public function getMockObjectFactory()
    {
        /** @var \Box\TestScribe\Mock\MockObjectFactory $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\Mock\\MockObjectFactory');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\Mock\FullMockObjectFactory
     */
    public function getFullMockObjectFactory()
    {
        /** @var \Box\TestScribe\Mock\FullMockObjectFactory $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\Mock\\FullMockObjectFactory');

        return $obj;
    }

    /**
     * @return \Box\TestScribe\Utils\FileUtil
     */
    public function getFileUtil()
    {
        /** @var FileUtil $obj */
        $obj = $this->getClassInstance('\\Box\\TestScribe\\Utils\\FileUtil');

        return $obj;
    }
}
