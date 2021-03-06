<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests;

use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\SshTaskRunnerExtension;
use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks\BuildSshCommand;
use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tasks\RunSshCommand;
use Mashbo\Mashbot\TaskRunner\TaskRunner;

class SshTaskRunnerExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testItAddsTasks()
    {
        $runner = $this
            ->getMockBuilder(TaskRunner::class)
            ->disableOriginalConstructor()
            ->getMock();
        $runner
            ->expects($this->at(0))
            ->method('add')
            ->with('ssh:command:run', $this->callback(function($arg) {
                return $arg instanceof RunSshCommand;
            }));

        $runner
            ->expects($this->at(1))
            ->method('add')
            ->with('ssh:command:build', $this->callback(function($arg) {
                return $arg instanceof BuildSshCommand;
            }));

        $sut = new SshTaskRunnerExtension();
        $sut->amendTasks($runner);
    }
}
