<?php

/**
 * This file is part of git-precommit-handler
 *
 * (c) SCTR Services 2015
 *
 * This source file is proprietary
 */

namespace Aequasi\PreCommitHandler;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class Handler extends Application
{

    /**
     * @type array
     */
    private $commands;

    /**
     * @param array $commands
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
        parent::__construct('Pre Commit Handler');
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            [
                '',
                '<comment>--- <question>Pre-Commit Handler</question> ---</comment>',
                '',
                '',
                '<info>Running Pre-Commit hooks.</info>'
            ]
        );


        $status = 1;
        foreach ($this->commands as $command) {
            $process = new Process($command, __DIR__ . '../../');
            $output->write($command."......");
            if ($process->run() === 1) {

                $output->writeln(' Failed.');
                $output->writeln("<error>{$command} failed</error>");
                $output->writeln($process->getOutput());
                $output->writeln("<error>{$command} failed</error>");

                return 1;
            }
            $output->writeln(' Success.');

        }

        $output->writeln(
            [
                '',
                "<info>Finished running Pre-Commit hooks.</info>",
                '<comment>-------------------------</comment>',
                ''
            ]
        );
    }
}
