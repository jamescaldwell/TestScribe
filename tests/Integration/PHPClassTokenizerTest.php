<?php

namespace Box\TestScribe\Integration;

use Box\TestScribe\Config\PHPClassTokenizer;
use PHPUnit_Framework_TestCase;

/**
 * Class PHPClassTokenizerTest
 */
class PHPClassTokenizerTest extends PHPUnit_Framework_TestCase
{
    public function testParseAndSetClassNameAndNamespaceReturnsClass()
    {
        $file = __DIR__ . '/../_fixture/_input/Calculator.php';
        $tokenize = new PHPClassTokenizer($file);
        $tokenize->parseAndSetClassNameAndNamespace();
        $classes = $tokenize->getClassesDeclared();
        $this->assertCount(1, $classes, "Only one class should be returned for file: " . $file);
        $this->assertEquals("\\Box\\TestScribe\\_fixture\\_input\\Calculator", $classes[0], 'Class found should be equal to Calculator');
    }
}
