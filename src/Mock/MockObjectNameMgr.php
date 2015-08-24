<?php


namespace Box\TestScribe\Mock;


/**
 * Stateful service that manages the creation of mock object names.
 */
class MockObjectNameMgr
{
    /**
     * simple class name => count of its appearance
     *
     * @var array
     */
    private $classNameMap = [];

    /**
     * Return an unique mock object name for the given simple class name.
     *
     * This method will save the information about this call
     * so that it will return a different name
     * next time the method is called with the same class name.
     *
     * @param string $simpleClassName
     *
     * @return string
     */
    public function getMockObjectName($simpleClassName)
    {
        $classNameMap = $this->classNameMap;
        $keyExists = array_key_exists($simpleClassName, $classNameMap);
        if ($keyExists) {
            $oldCount = $classNameMap[$simpleClassName];
            $newCount = $oldCount + 1;
            $countStr = (string) $newCount;
            $this->classNameMap[$simpleClassName] = $newCount;
        } else {
            $countStr = '';
            $this->classNameMap[$simpleClassName] = 0;
        }

        $mockClassName = "mock$simpleClassName$countStr";

        return $mockClassName;
    }
}
