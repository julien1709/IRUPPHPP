<?php

@ini_set('display_errors', 'ON');

const MYSQL_USER = 'root';
const MYSQL_PASSWORD = 'root';
const MYSQL_HOST = 'localhost:3307';
const MYSQL_DATABASE = 'projetphp';

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
    $pdo = new PDO(
        "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
        MYSQL_USER, //Username
        MYSQL_PASSWORD, //Password
        $pdoOptions //Options
    );
}catch(PDOException $e){
    throw new PDOException($e->getMessage(), $e->getCode());
}

?>