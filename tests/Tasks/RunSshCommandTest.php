<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks\RunSshCommand;
use Mashbo\Mashbot\TaskRunner\Tests\Functional\TaskTest;

class RunSshCommandTest extends TaskTest
{
    public function test_command_is_run_via_process_command()
    {
        $connection = [
            'host' => 'example.com',
            'user' => 'test',
            'port' => 22
        ];
        $sshCommand = new Command("ssh 'test@example.com' -p 22 'ls -a1'");
        $this->runner
            ->invoke('ssh:command:build', ['command' => 'ls -a1', 'connection' => $connection])
            ->shouldBeCalled()
            ->willReturn($sshCommand);

        $this->runner
            ->invoke('process:command:run', ['command' => $sshCommand])
            ->shouldBeCalled()
            ->willReturn(['stdout' => ".\n..", 'stderr' => '', 'status' => 0]);

        $result = $this->invoke(['connection' => $connection, 'command' => 'ls -a1']);
        $this->assertEquals(['stdout' => ".\n..", 'stderr' => '', 'status' => 0], $result);
    }

    /**
     * @return callable
     */
    protected function getTask()
    {
        return new RunSshCommand;
    }
}
