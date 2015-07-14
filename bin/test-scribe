#!/usr/bin/env php
<?php

$autoLoaderFilePath = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoLoaderFilePath)) {
    require_once $autoLoaderFilePath;
} else {
    die(
        'You need to set up the project dependencies using the following commands:' . PHP_EOL .
        'wget http://getcomposer.org/composer.phar' . PHP_EOL .
        'php composer.phar install' . PHP_EOL
    );
}

$application = new Box\TestScribe\CLI\Application;
$application->run();
