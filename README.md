# Graceful Shutdown with PHP

[![Build Status](https://travis-ci.org/leocarmo/graceful-shutdown-php.svg?branch=master)](https://travis-ci.org/leocarmo/graceful-shutdown-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/leocarmo/graceful-shutdown-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/leocarmo/graceful-shutdown-php/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/leocarmo/graceful-shutdown-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Total Downloads](https://img.shields.io/packagist/dt/leocarmo/graceful-shutdown-php.svg)](https://packagist.org/packages/leocarmo/graceful-shutdown-php)

> Generally, a graceful shutdown is preferable in the case of any OS that saves its state. When the standard shutdown procedures are not done with these OSs, the result can be data corruption of program and operating system files. The result of the corruption can be instability, incorrect functioning or failure to boot.

For more information see [this](https://whatis.techtarget.com/definition/graceful-shutdown-and-hard-shutdown).

## Composer
`composer require leocarmo/graceful-shutdown-php`

## How to use
This is very simple, you just have to call the `check` method inside a while loop and the magic will happen.

```php
use LeoCarmo\GracefulShutdown\GracefulShutdown;

$shutdown = new GracefulShutdown();

while (! $shutdown->signalReceived()) {

    echo 'Start long task...' . PHP_EOL;
    sleep(sleep(5)); // --> when a signal is sent, sleep returns the number of seconds left
    echo 'End long task...' . PHP_EOL;

}

echo 'Graceful shutdown!';
```

Output result with debug enabled:
```
Start long task...
End long task...
Start long task...
^C##################### ---> Signal received: [2]
End long task...
Graceful shutdown!
```

Run `make run-exemple` to see this in action

## Roadmap
* [ ] Tests

## Credits
- [Leonardo Carmo](https://github.com/leocarmo)