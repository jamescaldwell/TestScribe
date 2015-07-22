<?php
/**
 *
 */

namespace Box\TestScribe;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Command line options
 *
 * Class CmdOption
 *
 * @package Box\TestScribe
 */
class CmdOption
{
    // Arguments
    const METHOD_NAME_KEY = 'method';
    const SOURCE_FILE_NAME_KEY = 'class-source';

    // Options
    const TEST_SOURCE_ROOT_OPTION_NAME = 'test-source-root';
    const SOURCE_ROOT_OPTION_NAME = 'source-root';

    // This option is mainly designed to make testing easier.
    const OVERWRITE_EXISTING_DESTINATION_FILE_OPTION = 'overwrite-dest-file';
    const SOURCE_CLASS_NAME_OPTION = 'class';
    const DESTINATION_CLASS_NAME_OPTION = 'test-class';
    const BOOT_STRAP_FILE_PATH_OPTION = 'bootstrap';

    /**
     * Configures the command.
     *
     * @param \Box\TestScribe\CLI\GenerateTestCommand $cmd
     *
     * @return null
     */
    static public function configure(
        \Box\TestScribe\CLI\GenerateTestCommand $cmd
    )
    {
        $cmd->setName('generate-test')
            ->setDescription('Generate a test class based on a class')
            ->addArgument(
                self::SOURCE_FILE_NAME_KEY,
                InputArgument::REQUIRED,
                'The source file that declared the class to generate a test class for'
            )
            ->addArgument(
                self::METHOD_NAME_KEY,
                InputArgument::REQUIRED,
                'The name of the method to generate a test for'
            )
            ->addOption(
                self::SOURCE_CLASS_NAME_OPTION,
                null,
                InputOption::VALUE_REQUIRED,
                'The name of the class to generate a test class for'
            )
            ->addOption(
                self::DESTINATION_CLASS_NAME_OPTION,
                null,
                InputOption::VALUE_REQUIRED,
                'The name of the test class that is to be generated'
            )
            ->addOption(
                self::TEST_SOURCE_ROOT_OPTION_NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'The root directory of the test files.'
            )
            ->addOption(
                self::SOURCE_ROOT_OPTION_NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'The root directory of the production source files.'
            )
            ->addOption(
                self::BOOT_STRAP_FILE_PATH_OPTION,
                null,
                InputOption::VALUE_REQUIRED,
                'A "bootstrap" PHP file that is run at startup'
            )->addOption(
                self::OVERWRITE_EXISTING_DESTINATION_FILE_OPTION,
                'o',
                InputOption::VALUE_NONE,
                'Overwrite destination test file if it exists. Use default test method name.'
            );
    }
}
