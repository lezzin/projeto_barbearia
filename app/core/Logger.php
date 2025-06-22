<?php

namespace App\Core;

use InvalidArgumentException;

class Logger
{
    protected string $logFile;
    protected static ?Logger $instance = null;

    protected array $levels = [
        'debug',
        'info',
        'notice',
        'warning',
        'error',
        'critical',
        'alert',
        'emergency'
    ];

    protected function __construct(string $logFile = 'logs/app.log')
    {
        $this->logFile = $logFile;

        $dir = dirname($logFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    public static function getInstance(string $logFile = 'logs/app.log'): Logger
    {
        if (self::$instance === null) {
            self::$instance = new Logger($logFile);
        }
        return self::$instance;
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $level = strtolower($level);
        if (!in_array($level, $this->levels)) {
            throw new InvalidArgumentException("Nível de log inválido: $level");
        }

        $date = date('Y-m-d H:i:s');
        $interpolatedMessage = $this->interpolate($message, $context);
        $logEntry = "[$date] [$level] $interpolatedMessage" . PHP_EOL;

        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

    public function debug(string $message, array $context = []): void
    {
        $this->log('debug', $message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    public function notice(string $message, array $context = []): void
    {
        $this->log('notice', $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }

    public function critical(string $message, array $context = []): void
    {
        $this->log('critical', $message, $context);
    }

    public function alert(string $message, array $context = []): void
    {
        $this->log('alert', $message, $context);
    }

    public function emergency(string $message, array $context = []): void
    {
        $this->log('emergency', $message, $context);
    }

    protected function interpolate(string $message, array $context): string
    {
        $replace = [];

        foreach ($context as $key => $val) {
            $replace["{{$key}}"] = is_scalar($val) ? $val : json_encode($val);
        }

        return strtr($message, $replace);
    }
}
