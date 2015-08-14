<?php

namespace Box\TestScribe\Exception;

/**
 * User initiated abortion of the test run.
 *
 * Inherit from Exception instead of TestScribeException
 * because we want to treat this one differently.
 */
class AbortException extends \Exception
{

}
