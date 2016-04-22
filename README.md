# SSH TaskRunner extension

This extension requires the process-taskrunner-extension to also be enabled.

Usage:

    <?php

    use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\SymfonyProcessRunner;
    use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\ProcessTaskRunnerExtension;
    use Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\SshTaskRunnerExtension;
    use Mashbo\Mashbot\TaskRunner\TaskRunner;
    use Symfony\Component\Process\Process;

    require __DIR__ . '/vendor/autoload.php';

    $server = [
        'user' => "root",
        'host' => '46.101.85.183',
        'port' => 22
    ];
    $command = "date";

    $taskRunner = new TaskRunner(new \Psr\Log\NullLogger());
    $taskRunner->extend(new ProcessTaskRunnerExtension(new SymfonyProcessRunner()));
    $taskRunner->extend(new SshTaskRunnerExtension());
    $command = $taskRunner->invoke('ssh:command:run', ['command' => $command, 'connection' => $server]);

    // $command is now ['stdout' => "Fri Apr 22 15:20:45 BST 2016", 'stderr' => "", 'status' => 0]
