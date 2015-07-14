<?php

use Box\TestScribe\_fixture\_input\TestMethodsProvider;
use Box\TestScribe\_fixture\Directory;
use Box\TestScribe\_fixture\TestCreator;

include_once __DIR__ . '/../bootstrapForTest.php';

// Update the expected generated test files

$expectedTestsDir = Directory::getExpectedTestsDir();

$methodsDataArray = TestMethodsProvider::getTestMethods();

foreach ($methodsDataArray as $testMethodData) {
    list($className, $methodName, $answerFileName) = $testMethodData;
    TestCreator::createTest($className, $methodName, $expectedTestsDir, $answerFileName);
}
