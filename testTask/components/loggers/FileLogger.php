<?php


namespace components\loggers;

use components\interfaces\LoggerInterface;

class FileLogger implements LoggerInterface
{
    private $type = 'file';

    public function send(string $message): void
    {
        // Logging to file
        $filePath = __DIR__ . '/../../runtime/logs/app.log';
        file_put_contents($filePath, $message . PHP_EOL, FILE_APPEND);
        echo "$message was sent via file ";
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        if ($loggerType === $this->type) {
            $this->send($message);
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}