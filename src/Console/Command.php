<?php

namespace nojes\employees\Console;

/**
 * Extended Command.
 * @author Vyacheslav Nozhenko <vv.nojenko@gmail.com>
 */
class Command extends \Illuminate\Console\Command
{
    /**
     * Write a string as information output with indent.
     *
     * @param  string  $string
     * @param  null|int|string  $verbosity
     * @return void
     */
    public function info($string, $verbosity = null)
    {
        $this->line("\n$string", 'info', $verbosity);
    }

    /**
     * Call another console command with write a string as information output.
     *
     * @param string $infoString
     * @param string $command
     * @param array $arguments
     */
    public function callWithInfo($infoString = '', $command = '', $arguments = [])
    {
        $this->info($infoString);
        $this->call($command, $arguments);
    }
}
