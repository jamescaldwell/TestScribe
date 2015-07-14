<?php
/**
 *
 */

namespace Box\TestScribe;


/**
 * Class MethodArgumentServiceTest
 *
 * @package Box\TestScribe
 */
class MethodArgumentServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFullyQualifiedClassNameIfAvailable()
    {
        $class = new \ReflectionClass('\Box\TestScribe\_fixture\_input\CalculatorUtil');
        $method = $class->getMethod('calc');
        $service = new MethodArgumentService();
        $className = $service->getFullyQualifiedClassNameIfAvailable($method, 'calculator');
        $this->assertSame(
            '\Box\TestScribe\_fixture\_input\Calculator',
            $className
        );
    }
} 
