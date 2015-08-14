<?php

namespace Box\TestScribe;

use Box\TestScribe\Mock\MockClass;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Hold global variables and methods
 */
class App
{
    /**
     * @var OutputInterface;
     */
    static private $output = null;

    /**
     * @var AppInstance
     */
    static private $appInstance;

    /**
     * @param \Box\TestScribe\AppInstance $appInstance
     *
     * @return void
     */
    public static function init(
        AppInstance $appInstance
    )
    {
        self::$appInstance = $appInstance;
    }
    
    /**
     * @return OutputInterface
     */
    public static function getOutput()
    {
        return self::$output;
    }

    /**
     * @var  string
     *
     * The dependency management system used by the the method under test
     * is expected to implement the following method
     * inputs:
     *   class name being instantiated as string
     *   mock instance
     * return value will be ignored.
     *
     * setInjectMockedObjectMethodName method should be called with the name of the
     * method mentioned above in the bootstrap script supplied to this tools'
     * via the command line argument.
     */
    static private $injectMockedObjectMethodName;

    /**
     * @var  string
     *
     * The dependency management system used by the the method under test
     * is expected to implement the following method
     * inputs:
     *   class name of the class whose static methods are called as string
     *   mock class name as string
     * return value will be ignored.
     *
     * setInjectMockedClassMethodName method should be called with the name of the
     * method mentioned above in the bootstrap script supplied to this tools'
     * via the command line argument.
     */
    static private $injectMockedClassMethodName;

    /**
     * Set to true to signal to the dependency injection/lookup
     * system to start calling our createMockedInstance method
     * to inject our mock objects.
     *
     * @var bool
     */
    static public $shouldInjectMockObjects = false;
    
    /**
     * The dependency management system used by the method under test should call this method
     * to return a mocked object when instantiation of a class is requested.
     * Return null if users decide not to mock this object and have the dependency management
     * system create the real object.
     *
     * @param string $className
     * @param array  $arguments
     *
     * @return MockClass|null
     */
    public static function createMockedInstance(
        $className,
        $arguments
    )
    {
        $injectedMockMgr = self::$appInstance->getInjectedMockMgr();  
        $result = $injectedMockMgr->createMockInstance(
            $className,
            $arguments
        );
        
        return $result;
    }

    /**
     * The dependency management system used by the method under test should call this method
     * to return a mocked class name when a class mock is requested
     * to be used to invoke a static method.
     *
     * Return null if users decide not to mock this object and have the dependency management
     * system use the real class.
     *
     * @param string $className
     *
     * @return string|null
     */
    public static function createMockedClass(
        $className
    )
    {
        $injectedMockClassMgr = self::$appInstance->getInjectedMockClassMgr();  
        $result = $injectedMockClassMgr->createMockedClass(
            $className
        );
        
        return $result;
    }

    /**
     * Set where output should go.
     * Tests may not call this method
     * so that console output doesn't cause phpunit tests to fail in strict mode.
     *
     * @param OutputInterface $output
     *
     * @return void
     */
    static public function setOutput($output)
    {
        self::$output = $output;
    }

    /**
     * Write output. This is intended for displaying information to users.
     * Not for debugging.
     *
     * @param string $message
     *
     * @return void
     */
    static public function writeOutput($message)
    {
        if (self::$output) {
            self::$output->write($message);
        }
    }

    /**
     * Write output and add a new line to it.
     *
     * @param string $message
     *
     * @return null
     */
    static public function writeln($message)
    {
        self::writeOutput($message);
        self::writeOutput("\n");
    }

    /**
     * @return string
     */
    public static function getInjectMockedObjectMethodName()
    {
        return self::$injectMockedObjectMethodName;
    }

    /**
     * @param string $injectMockedObjectMethodName
     *
     * @return null
     */
    public static function setInjectMockedObjectMethodName($injectMockedObjectMethodName)
    {
        self::$injectMockedObjectMethodName = $injectMockedObjectMethodName;
    }

    /**
     * @param string $injectMockedClassMethodName
     */
    public static function setInjectMockedClassMethodName($injectMockedClassMethodName)
    {
        self::$injectMockedClassMethodName = $injectMockedClassMethodName;
    }

    /**
     * @return string
     */
    public static function getInjectMockedClassMethodName()
    {
        return self::$injectMockedClassMethodName;
    }
}
