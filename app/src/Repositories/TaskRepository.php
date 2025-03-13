<?php

declare(strict_types=1);

namespace Src\Repositories;

use PDO;
use Src\Database\Connection as DB;
use stdClass;

class TaskRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::instance();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO tasks
            (title, description, status)
            VALUES (:title, :description, :status)"
        );

        return $stmt->execute($data);
    }

    public function read(): array
    {
        $stmt = $this->db->query("SELECT * FROM tasks");

        return $stmt->fetchAll();
    }

    public function readOne(int $id): \stdClass
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function update(int $id, array $data): bool
    {
        $updateQuery = "UPDATE tasks SET ";

        foreach ($data as $key => $value) {
            $updateQuery .=  "{$key}=:{$key}, ";
        }

        $updateQuery = rtrim($updateQuery, ', ');

        $updateQuery .= " WHERE id=:id";

        $stmt = $this->db->prepare($updateQuery);

        return $stmt->execute([...$data, 'id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id=:id");

        return $stmt->execute(['id' => $id]);
    }
}
