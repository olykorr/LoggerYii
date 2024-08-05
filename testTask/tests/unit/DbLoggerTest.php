<?php
namespace tests\unit;

use components\loggers\DbLogger;
use yii\db\Connection;
use Yii;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../_bootstrap.php';

class DbLoggerTest extends TestCase
{
    private $logger;

    protected function setUp(): void
    {
        parent::setUp();

        // Инициализация базы данных и очистка таблицы логов
        $db = Yii::$app->db;
        $db->createCommand('TRUNCATE TABLE log')->execute();

        // Создание экземпляра DbLogger с объектом Connection
        $this->logger = new DbLogger($db);
    }

    public function testSend()
    {
        $message = "Test DB message".date('Y-m-d H:m:s');

        $this->logger->send($message);

        // Check saveing message to db
        $log = Yii::$app->db->createCommand('SELECT * FROM log WHERE message=:message')
            ->bindValue(':message', $message)
            ->queryOne();

        $this->assertNotNull($log, "Log entry not found in the database.");
        $this->assertEquals($message, $log['message'], "Log message does not match.");
    }
}
