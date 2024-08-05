<?php


namespace app\controllers;

use yii\web\Controller;
use components\factory\LoggerFactory;

class LogController extends Controller
{
    public function actionLog()
    {
        $defaultType = 'file'; // Пример, можно использовать из конфигурации
        $logger = LoggerFactory::createLogger($defaultType);
        $logger->send('Это сообщение для логирования.');
    }

    public function actionLogTo(string $type)
    {
        $logger = LoggerFactory::createLogger($type);
        $logger->send('Это сообщение для логирования.');
    }

    public function actionLogToAll()
    {
        $loggers = ['email', 'file', 'db'];
        foreach ($loggers as $type) {
            $logger = LoggerFactory::createLogger($type);
            $logger->send("Это сообщение для логирования через $type логгер.");
        }
    }
}