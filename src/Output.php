<?php
/**
 *
 */

namespace Box\TestScribe;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Output
 *
 * Responsible for displaying outputs.
 *
 * @package Box\TestScribe
 */
class Output 
{
    const SEPARATOR_LENGTH = 50;

    /**
     * @var OutputInterface
     */
    private $out;

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $out
     */
    function __construct(OutputInterface $out)
    {
        $this->out = $out;
    }

    /**
     * @param string $msg
     *
     * @return void
     */
    public function write($msg)
    {
        $this->out->write($msg);
    }

    /**
     * @param string $msg
     *
     * @return void
     */
    public function writeln($msg)
    {
        $this->out->writeln($msg);
    }

    /**
     * @return void
     */
    public function writeStartSeparator()
    {
        $separator = str_repeat('-', self::SEPARATOR_LENGTH);
        $this->out->writeln($separator);
    }

    /**
     * @return void
     */
    public function writeEndSeparator()
    {
        $separator = str_repeat('=', self::SEPARATOR_LENGTH);
        $this->out->writeln($separator);
    }

}
