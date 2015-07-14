<?php
namespace Box\TestScribe;

use Box\TestScribe\_fixture\_input\User;

/**
 * Class ValueAssertionRendererTest
 * @package Box\TestScribe
 */
class ValueAssertionRendererTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Renderers\ValueAssertionRenderer::generate
     */
    public function testGenerateForObjects()
    {
        // Setup mocks for the constructor of the class under test when required.
        $mockOutput0 = $this->shmock(
            '\Box\TestScribe\Output',
            function (
                $shmock
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();
            }
        );

        $mockObjectValueAssertionRenderer1 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\ObjectValueAssertionRenderer',
            function (
                $shmock
                /** @var \Box\TestScribe\Renderers\ObjectValueAssertionRenderer|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();
                
                // @TODO (ryang 1/13/15) : validate the input including the user object.
                $shmock->generateForAnObject()->return_value('gen');

            }
        );
        $mockScalarOrNullValueAssertionRenderer2 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\ScalarOrNullValueAssertionRenderer',
            function (
                $shmock
                /** @var \Box\TestScribe\Renderers\ScalarOrNullValueAssertionRenderer|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();
                
            }
        );
        
        $objectUnderTest = new Renderers\ValueAssertionRenderer($mockOutput0, $mockObjectValueAssertionRenderer1, $mockScalarOrNullValueAssertionRenderer2);
        $user = new User('bob');
        $executionResult = $objectUnderTest->generate('user', $user);

        $expectedString = 'gen';
        
        $this->assertSame(
            $expectedString,
            $executionResult,
            "The execution result doesn't match."
        );
    }
    
    /**
     * @covers Box\TestScribe\Renderers\ValueAssertionRenderer::generate
     */
    public function testGenerateNotSupportedValueType()
    {
        // Setup mocks for the constructor of the class under test when required.
        $mockOutput0 = $this->shmock(
            '\Box\TestScribe\Output',
            function (
                $shmock
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

                $shmock->writeln(
                    'Assertion for a variable ( var1 ) with type ( resource ) is not supported yet.'
                );
            }
        );
        
        $mockObjectValueAssertionRenderer1 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\ObjectValueAssertionRenderer',
            function (
                $shmock
                /** @var \Box\TestScribe\Renderers\ObjectValueAssertionRenderer|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

            }
        );
        $mockScalarOrNullValueAssertionRenderer2 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\ScalarOrNullValueAssertionRenderer',
            function (
                $shmock
                /** @var \Box\TestScribe\Renderers\ScalarOrNullValueAssertionRenderer|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

            }
        );
        

        $objectUnderTest = new Renderers\ValueAssertionRenderer($mockOutput0, $mockObjectValueAssertionRenderer1, $mockScalarOrNullValueAssertionRenderer2);
        $handle = curl_init();
        $executionResult = $objectUnderTest->generate('var1', $handle);
        $this->assertSame(
            '',
            $executionResult,
            "The execution result should be an empty string."
        );
        curl_close($handle);
    }
}
