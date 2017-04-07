<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'product');

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Itb\WebApplication();
$app->run();