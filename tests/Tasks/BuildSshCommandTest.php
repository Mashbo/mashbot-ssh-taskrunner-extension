<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks\BuildSshCommand;
use Mashbo\Mashbot\TaskRunner\Tests\Functional\TaskTest;

class BuildSshCommandTest extends TaskTest
{
    public function test_command_is_run_via_process_command()
    {
        $this->runner
            ->invoke('process:command:build', ['command' => "ssh 'test@example.com' -p 22 'ls -a1'"])
            ->shouldBeCalled()
            ->willReturn(new Command("ssh 'test@example.com' -p 22 'ls -a1'"));

        $result = $this->invoke(['connection' => ['host' => 'example.com', 'user' => 'test', 'port' => 22], 'command' => 'ls -a1']);
        $this->assertEquals(new Command("ssh 'test@example.com' -p 22 'ls -a1'"), $result);
    }

    public function test_port_can_be_omitted_accepting_system_defaults()
    {
        $this->runner
            ->invoke('process:command:build', ['command' => "ssh 'test@example.com' 'ls -a1'"])
            ->shouldBeCalled()
            ->willReturn(new Command("ssh 'test@example.com' 'ls -a1'"));

        $result = $this->invoke(['connection' => ['host' => 'example.com', 'user' => 'test'], 'command' => 'ls -a1']);
        $this->assertEquals(new Command("ssh 'test@example.com' 'ls -a1'"), $result);
    }

    /**
     * @return callable
     */
    protected function getTask()
    {
        return new BuildSshCommand();
    }
}
