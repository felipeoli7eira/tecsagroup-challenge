<?php

declare(strict_types=1);

date_default_timezone_set('America/Sao_Paulo');

use Src\Database\DatabaseBootstrap;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../router/router.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

new DatabaseBootstrap();
