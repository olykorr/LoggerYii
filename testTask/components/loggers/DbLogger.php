<?php

namespace components\loggers;

use components\interfaces\LoggerInterface;
use yii\db\Connection;

class DbLogger implements LoggerInterface
{
    private $db;
    private $type = 'db';

    /**
     * Конструктор класса DbLogger.
     *
     * @param Connection $db Объект подключения к базе данных
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Отправляет сообщение в базу данных.
     *
     * @param string $message Сообщение для записи в базу данных
     * @return void
     */
    public function send(string $message): void
    {
        // Записываем сообщение в базу данных
        try {
            $this->db->createCommand()
                ->insert('log', ['message' => $message])
                ->execute();
            echo "$message was sent via db\n";
        } catch (\Exception $e) {
            echo "Failed to send message to DB: " . $e->getMessage() . "\n";
        }
    }

    /**
     * Отправляет сообщение по выбранному типу логирования.
     *
     * @param string $message Сообщение для отправки
     * @param string $loggerType Тип логирования
     * @return void
     */
    public function sendByLogger(string $message, string $loggerType): void
    {
        if ($loggerType === $this->type) {
            $this->send($message);
        }
    }

    /**
     * Получает текущий тип логирования.
     *
     * @return string Тип логирования
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Устанавливает текущий тип логирования.
     *
     * @param string $type Тип логирования
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
