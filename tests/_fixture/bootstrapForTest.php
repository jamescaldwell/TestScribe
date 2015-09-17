<?php
/**
 *
 */
use Box\TestScribe\_fixture\Directory;

require_once __DIR__ . '/../../vendor/autoload.php';

// Instruct the test generator which methods to use to
// generate the mock object registration/injection statement.
\Box\TestScribe\App::setInjectMockedObjectMethodName(
    '\\Box\\TestScribe\\_fixture\\ServiceLocator::overwrite'
);
\Box\TestScribe\App::setInjectMockedClassMethodName(
    '\\Box\\TestScribe\\_fixture\\StaticServiceLocator::overwrite'
);

Directory::init();
