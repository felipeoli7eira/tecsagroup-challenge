<?php

use \Pecee\SimpleRouter\SimpleRouter as Router;

require_once __DIR__ . '/routes.php';

try {
    Router::setDefaultNamespace('\Src\Controllers');
    Router::start();
} catch (\Throwable $exception) {
    var_dump($exception);
}
