<?php

@ini_set('display_errors', 'ON');

define('MYSQL_USER', '');
define('MYSQL_PASSWORD', 'projet');
define('MYSQL_HOST', 'localhost');
define('MYSQL_DATABASE', 'arduino');

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);


$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);

?><?php
