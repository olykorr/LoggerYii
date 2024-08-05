<?php


namespace tests\unit;

use components\loggers\FileLogger;
use PHPUnit\Framework\TestCase;


class FileLoggerTest extends TestCase
{
    public function testSend()
    {
        $logger = new FileLogger();
        $message = "Test message";

        $filePath = __DIR__ . '/../../runtime/logs/app.log';
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $logger->send($message);

        // Check saveing message
        $this->assertFileExists($filePath);
        $this->assertStringEqualsFile($filePath, $message . PHP_EOL);
    }
}