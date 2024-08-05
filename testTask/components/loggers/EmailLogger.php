<?php


namespace components\loggers;

use components\interfaces\LoggerInterface;

class EmailLogger implements LoggerInterface
{
    private $type = 'email';

    public function send(string $message): void
    {
        echo "$message was sent via email";
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