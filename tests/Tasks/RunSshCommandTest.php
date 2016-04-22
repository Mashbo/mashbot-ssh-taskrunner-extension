<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests\Tasks;

use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks\RunSshCommand;
use Mashbo\Mashbot\TaskRunner\Tests\Functional\TaskTest;

class RunSshCommandTest extends TaskTest
{
    public function test_command_is_run_via_process_command()
    {
        $this->runner
            ->invoke('process:run', ['command' => "ssh 'test@example.com' -p 22 'ls -a1'"])
            ->shouldBeCalled()
            ->willReturn(['stdout' => ".\n..", 'stderr' => '', 'status' => 0]);

        $result = $this->invoke(['connection' => ['host' => 'example.com', 'user' => 'test', 'port' => 22], 'command' => 'ls -a1']);
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
