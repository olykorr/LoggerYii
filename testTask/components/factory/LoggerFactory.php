<?php
namespace components\factory;

use components\loggers\EmailLogger;
use components\loggers\FileLogger;
use components\loggers\DbLogger;

class LoggerFactory
{
    public static function createLogger(string $type): LoggerInterface
    {
        switch ($type) {
            case 'email':
                return new EmailLogger();
            case 'file':
                return new FileLogger();
            case 'db':
                return new DbLogger();
            default:
                throw new \Exception("Logger type '$type' is not supported.");
        }
    }
}