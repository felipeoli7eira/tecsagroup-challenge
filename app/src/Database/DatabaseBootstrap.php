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
        $this->createUsersTableIfNotExists();
        $this->createPersonalAccessTokensTableIfNotExists();
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

    private function createUsersTableIfNotExists(): void
    {
        $stmt = $this->database->prepare("
            CREATE TABLE IF NOT EXISTS users (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
            );
        ");

        $stmt->execute();
    }

    private function createPersonalAccessTokensTableIfNotExists(): void
    {
        $stmt = $this->database->prepare("
            CREATE TABLE IF NOT EXISTS personal_access_tokens (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                token VARCHAR(255) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

                CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
            );
        ");

        $stmt->execute();
    }
}
