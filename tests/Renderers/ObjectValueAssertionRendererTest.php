<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\_fixture\_input\User;

/**
 * Generated by PHPUnit_test_Generator.
 */
class ObjectValueAssertionRendererTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Renderers\ObjectValueAssertionRenderer::generateForAnObject
     * 
     * Manual test because when the object is a mocked object, the type string will contain dynamic information. 
     */
    public function testGenerateForAnObject()
    {
        // Setup mocks for parameters to the method under test.

        $user = new User('Bob');
        
        // Setup mocks for parameters to the constructor.

        $mockMockClassUtil0 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\MockClassUtil',
            function (
                $shmock
                /** @var \Box\TestScribe\Utils\MockClassUtil|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

                $mock = $shmock->isMockClass('Box\TestScribe\_fixture\_input\User');
                /** @var $mock \Shmock\Spec */
                $mock->return_value(false);
            }
        );

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Renderers\ObjectValueAssertionRenderer($mockMockClassUtil0);
        $executionResult = $objectUnderTest->generateForAnObject('var', $user);

        // Validate the execution result.

        $expected =
            '$this->assertInstanceOf(' . "\n" .
            '    \'Box\\\\TestScribe\\\\_fixture\\\\_input\\\\User\',' . "\n" .
            '    $var,' . "\n" . '    \'Variable ( var ) doesn\\\'t have the expected type.\'' . "\n" . ');' . "\n" .
            "\n" .
            '$this->assertSame(' . "\n" . '    \'{}\',' . "\n" .
            '    json_encode($var),' . "\n" .
            '    \'Variable ( var ) doesn\\\'t have the expected value.\'' . "\n" .
            ');' . "\n" .
            '';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
    
    
    /**
     * @covers Box\TestScribe\Renderers\ObjectValueAssertionRenderer::generateForAnObject
     * 
     * Manual unit test because when the object is a mocked object, the type string will 
     * contain dynamic information.
     * 
     * Modified from a generated test. 
     */
    public function testGenerateForAnMockedObject()
    {
        // Setup mocks for parameters to the method under test.

        $mockUser1 = $this->shmock(
            '\\Box\\TestScribe\\_fixture\\_input\\User',
            function (
                $shmock
                /** @var \Box\TestScribe\_fixture\_input\User|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

            }
        );
        // Setup mocks for parameters to the constructor.

        $mockMockClassUtil0 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\MockClassUtil',
            function (
                $shmock
                /** @var \Box\TestScribe\Utils\MockClassUtil|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

                // Modified.
                // Original generated code:
                // $mock = $shmock->isMockClass('ProxyManagerGeneratedProxy\\__PM__\\Box\\TestScribe\\_fixture\\_input\\User\\YToxOntzOjc6ImZhY3RvcnkiO3M6NDA6IlByb3h5TWFuYWdlclxGYWN0b3J5XFJlbW90ZU9iamVjdEZhY3RvcnkiO30�');
                /** @noinspection PhpParamsInspection */
                $mock = $shmock->isMockClass();
                /** @var $mock \Shmock\Spec */
                $mock->return_value(true);
            }
        );

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Renderers\ObjectValueAssertionRenderer($mockMockClassUtil0);
        $executionResult = $objectUnderTest->generateForAnObject('var', $mockUser1);

        // Validate the execution result.

        $expected =
            '$this->assertInstanceOf(' . "\n" .
            '    \'Box\\\\TestScribe\\\\_fixture\\\\_input\\\\User\',' . "\n" .
            '    $var,' . "\n" .
            '    \'Variable ( var ) doesn\\\'t have the expected type.\'' . "\n" .
            ');';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
