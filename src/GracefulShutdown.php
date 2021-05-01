<?php declare(strict_types=1);

namespace LeoCarmo\GracefulShutdown;

/**
 * Class GracefulShutdown
 *
 * @requires https://www.php.net/manual/pt_BR/book.pcntl.php
 *
 * @package LeoCarmo\GracefulShutdown
 */
class GracefulShutdown
{
    /**
     * @var int|null
     */
    protected ?int $signal = null;

    /**
     * @var array
     */
    protected array $signals;

    /**
     * @var bool
     */
    protected bool $debug;

    /**
     * GracefulShutdown constructor
     *
     * @param array $signals
     * @param bool $debug
     */
    public function __construct(
        array $signals = [SIGTERM, SIGINT, SIGUSR1, SIGUSR2, SIGQUIT, SIGHUP],
        bool $debug = false
    ) {
        $this->signals = $signals;
        $this->debug = $debug;
        $this->registerSignals();
    }

    /**
     * @param int $signal
     */
    public function __invoke(int $signal)
    {
        $this->debug("##################### ---> Signal received: [{$signal}]");
        $this->signal = $signal;
    }

    /**
     * Check if a signal was sent
     *
     * @return bool
     */
    public function signalReceived(): bool
    {
        return is_int($this->signal);
    }

    /**
     * Enable async signals and register
     */
    protected function registerSignals(): void
    {
        pcntl_async_signals(true);

        foreach ($this->signals as $signal) {
            pcntl_signal($signal, $this);
        }
    }

    /**
     * @param string $string
     */
    protected function debug(string $string): void
    {
        if ($this->debug) {
            echo $string . PHP_EOL;
        }
    }
}
