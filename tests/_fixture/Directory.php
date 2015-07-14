<?php


namespace Box\TestScribe\_fixture;

/**
 * Common directory path
 */
class Directory 
{
    static private $projectRoot;
    static private $inputDataDir;
    static private $expectedTestsDir;
    static private $fixtureDir;

    static public function init()
    {
        $currentDir = __DIR__;
        self::$fixtureDir = $currentDir;
        self::$projectRoot =
            $currentDir . DIRECTORY_SEPARATOR .
            "..". DIRECTORY_SEPARATOR .
            "..";

        self::$inputDataDir = "$currentDir/_input";
        self::$expectedTestsDir = "$currentDir/_expected";
    }

    /**
     * @return mixed
     */
    public static function getProjectRoot()
    {
        return self::$projectRoot;
    }

    /**
     * @return mixed
     */
    public static function getInputDataDir()
    {
        return self::$inputDataDir;
    }

    /**
     * @return mixed
     */
    public static function getExpectedTestsDir()
    {
        return self::$expectedTestsDir;
    }

    /**
     * @return mixed
     */
    public static function getFixtureDir()
    {
        return self::$fixtureDir;
    }

}
