<?php

$debug =  [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=hackathon',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

$live = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=hackathon',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

return YII_DEBUG ? $debug : $live;
