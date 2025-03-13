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
                $host = $_ENV['DB_HOST'] ?? 'database';
                $port = $_ENV['DB_PORT'] ?? 3306;
                $databaseName = $_ENV['DB_NAME'] ?? 'app';
                $user = $_ENV['DB_USER'] ?? 'root';
                $password = $_ENV['DB_PASS'] ?? 'root';

                self::$instance = new PDO("mysql:host={$host};port={$port};dbname={$databaseName}", $user, $password);
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
