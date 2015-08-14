<?php

namespace Box\TestScribe\Renderers;

/**
 * Render a non public method call statements.
 */
class NonPublicMethodExecutionRenderer
{
    /**
     * Return statements for invoking the test.
     *
     * @param \Box\TestScribe\Execution\ExecutionResult $executionResult
     *
     * @return string
     */
    /**
     * @param string $assignmentStr
     * @param bool   $isStatic
     * @param string $fullClassName
     * @param string $methodName
     * @param string $argumentsString
     * @param string $targetObjectName
     *
     * @return string
     */
    public function genNonPublicExecutionStatements(
        $assignmentStr,
        $isStatic,
        $fullClassName,
        $methodName,
        $argumentsString,
        $targetObjectName
    )
    {
        $classNameAsString = var_export($fullClassName, true);
        $methodNameAsString = var_export($methodName, true);
        if ($isStatic) {
            $invocationStatement = $this->renderNonPublicMethodInvocation(
                $assignmentStr,
                $classNameAsString,
                $methodNameAsString,
                'null',
                $argumentsString
            );
        } else {
            $invocationStatement = $this->renderNonPublicMethodInvocation(
                $assignmentStr,
                $classNameAsString,
                $methodNameAsString,
                '$' . $targetObjectName,
                $argumentsString
            );
        }

        return $invocationStatement;
    }

    /**
     * Assumption:
     *  The caller of this method expect the result of the execution to be assigned to
     *  a variable named $executionResult
     *
     * @param string $assignmentStr
     * @param string $className
     * @param string $methodName
     * @param string $targetObjectName
     * @param string $argumentsAsString
     *
     * @return string
     */
    private function renderNonPublicMethodInvocation(
        $assignmentStr,
        $className,
        $methodName,
        $targetObjectName,
        $argumentsAsString
    )
    {
        $statements = <<<TAG
\$reflectionClass = new \ReflectionClass($className);
\$reflectionMethod = \$reflectionClass->getMethod($methodName);
\$reflectionMethod->setAccessible(true);
$assignmentStr\$reflectionMethod->invokeArgs($targetObjectName, [$argumentsAsString]);
TAG;

        return $statements;
    }
}
