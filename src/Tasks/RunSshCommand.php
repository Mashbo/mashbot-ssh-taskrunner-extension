<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\TaskRunner\TaskContext;

class RunSshCommand
{
    public function __invoke(TaskContext $context, $connection, $command)
    {
        return $context
            ->taskRunner()
            ->invoke(
                'process:command:run',
                [
                    'command' => $context->taskRunner()->invoke('ssh:command:build', $context->arguments())
                ]
            );
    }
}