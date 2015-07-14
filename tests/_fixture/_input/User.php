<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Class User
 */
class User
{
    /**
     * @var string
     */
    private $name;
    private $nameHistory = [];

    /**
     * @param string $name
     */
    function __construct($name)
    {
        $this->addName($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getNameHistory()
    {
        return $this->nameHistory;
    }

    /**
     * @param string $newName
     *
     * @return void
     */
    public function changeName($newName = 'defaultNewName')
    {
        $this->addName($newName);
    }

    /**
     * @param $name
     *
     * @return void
     */
    private function addName($name)
    {
        $this->name = $name;
        $this->nameHistory = $name;
    }
}
