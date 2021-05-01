<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$shutdown = new LeoCarmo\GracefulShutdown\GracefulShutdown(
    [SIGTERM, SIGINT, SIGUSR1, SIGUSR2, SIGQUIT, SIGHUP],
    true
);

while (! $shutdown->signalReceived()) {

    echo 'Start long task...' . PHP_EOL;
    sleep(sleep(5)); // --> when a signal is sent, sleep returns the number of seconds left
    echo 'End long task...' . PHP_EOL;

}

echo 'Graceful shutdown!';

/**
Output result:

Start long task...
End long task...
Start long task...
^C##################### ---> Signal received: [2]
End long task...
Graceful shutdown!
 */