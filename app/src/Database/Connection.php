<?php

declare(strict_types=1);

namespace Src\Database;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function instance(): PDO
    {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new PDO('mysql:host=database;dbname=app', 'root', 'root');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $exception) {
                echo $exception->getMessage();
                exit($exception->getCode());
            }
        }

        return self::$instance;
    }
}
