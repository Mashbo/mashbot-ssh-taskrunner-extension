<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\TaskRunner\TaskContext;

class BuildSshCommand
{
    public function __invoke(TaskContext $context, $connection, $command)
    {
        $userAtHost = escapeshellarg($connection['user'] . '@' . $connection['host']);

        $portSpec = array_key_exists('port', $connection)
            ? " -p " . intval($connection['port'])
            : '';

        return $context->taskRunner()->invoke(
            'process:command:build', [
                'command' => sprintf("ssh %s%s %s", $userAtHost, $portSpec, escapeshellarg($command))
            ]
        );
    }
}