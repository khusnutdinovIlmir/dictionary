<?php

$config = require_once 'configDB.php';
$dbn = "mysql:host=" . $config['host'] . ";dbname=" . $config['db_name'] . ";charser=" . $config['charset'];
$conn = new PDO($dbn, $config['username'], $config['password']);

return $conn;