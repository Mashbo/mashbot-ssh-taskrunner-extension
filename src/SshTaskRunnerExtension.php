<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension;

use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks\BuildSshCommand;
use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks\RunSshCommand;
use Mashbo\Mashbot\TaskRunner\TaskRunner;
use Mashbo\Mashbot\TaskRunner\TaskRunnerExtension;

class SshTaskRunnerExtension implements TaskRunnerExtension
{
    public function amendTasks(TaskRunner $taskRunner)
    {
        $taskRunner->add('ssh:command:run', new RunSshCommand());
        $taskRunner->add('ssh:command:build', new BuildSshCommand());
    }
}
