<?php

namespace Box\TestScribe\CLI;

use Symfony\Component\Console\Application as AbstractApplication;

/**
 * TextUI frontend.
 */
class Application extends AbstractApplication
{
    const APP_VERSION = '0.3.7';

    /**
     *
     */
    public function __construct()
    {
        parent::__construct(
            'TestScribe',
            self::APP_VERSION
        );

        $this->add(new GenerateTestCommand());
        $this->setCatchExceptions(false);
    }
}
