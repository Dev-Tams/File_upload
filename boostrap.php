<?php

use App\Database;
use Dotenv\Dotenv;


$dotenv = Dotenv::createUnsafeImmutable(BASE_PATH);
$dotenv->load();

$config = require BASE_PATH .'config/database.php';
$dbConfig = $config['Database'];
$db = new Database($dbConfig);

$GLOBALS['db'] = $db;