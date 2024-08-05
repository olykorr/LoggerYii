<?php

use components\loggers\EmailLogger;
use components\loggers\FileLogger;
use components\loggers\DbLogger;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php'; // Обязательно добавьте это, если ваш проект не использует стандартный autoload

use yii\db\Connection;


$db = new Connection([
    'dsn' => 'mysql:host=localhost;dbname=yii2basic_test',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
]);


$emailLogger = new EmailLogger('test@example.com');
$fileLogger = new FileLogger('logs.txt');
$dbLogger = new DbLogger($db);

// Example message
$message = 'This is a log test message';

$emailLogger->send($message);
$fileLogger->send($message);
$dbLogger->send($message);
