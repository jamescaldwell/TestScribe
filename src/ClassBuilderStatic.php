<?php

namespace Box\TestScribe;

/**
 * Build classes dynamically for static invocation only.
 */
class ClassBuilderStatic
{
    /**
     * Create and load a class dynamically that is associated 1 to 1
     * to the given MockClass instance.
     * Used for static invocation only.
     * The class name is the same as the mock object name.
     *
     * @param MockClass $mock
     *
     * @return void
     */
    public function create($mock)
    {
        // The mock object name is unique.
        $className = $mock->getMockObjectName();
        $this->createAndLoadDynamicClass($className);

        // The dynamically generated class uses MockTraitStatic
        // which supports setMockInstance method.
        // This allows a static method invocation to be associated
        // with a unique instance of MockClass.
        /** @noinspection PhpUndefinedMethodInspection */
        $className::setMockInstance($mock);
    }

    /**
     * Create the class code dynamically.
     * The class is set up for static invocation only.
     * Load the created class.
     * The class name should be unique.
     *
     * @param string $uniqueClassName
     */
    private function createAndLoadDynamicClass($uniqueClassName)
    {
        $classDef = <<<EOF
class $uniqueClassName
{
    use \\Box\\TestScribe\\Mock\\MockTraitStatic;
}
EOF;
        eval($classDef);
    }
}
