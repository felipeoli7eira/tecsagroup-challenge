<?php

declare(strict_types=1);

namespace Src\Database;

use PDO;

class DatabaseBootstrap
{
    private readonly PDO $database;

    public function __construct()
    {
        $this->database = Connection::instance();

        $this->createTables();
    }

    private function createTables(): void
    {
        $this->createTasksTableIfNotExists();
    }

    private function createTasksTableIfNotExists(): void
    {
        $stmt = $this->database->prepare("
            CREATE TABLE IF NOT EXISTS tasks(
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL,
                status ENUM('do', 'doing', 'done') NOT NULL DEFAULT 'do',
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
            );
        ");

        $stmt->execute();
    }
}
