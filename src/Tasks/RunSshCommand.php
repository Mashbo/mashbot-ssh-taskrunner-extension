<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\TaskRunner\TaskContext;

class RunSshCommand
{
    public function __invoke(TaskContext $context, $connection, $command)
    {
        $userAtHost = escapeshellarg($connection['user'] . '@' . $connection['host']);
        $port = $connection['port'];
        
        return $context
            ->taskRunner()
            ->invoke(
                'process:run',
                [
                    'command' => sprintf("ssh %s -p %d %s", $userAtHost, $port, escapeshellarg($command))
                ]
            );
    }
}