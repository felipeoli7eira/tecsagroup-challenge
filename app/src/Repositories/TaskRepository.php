<?php

namespace Src\Repositories;

use PDO;
use Src\Database\Connection as DB;

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

    public function update(int $id, array $data)
    {
        // var_dump([...$data, 'id' => $id]);
        // exit();
        $stmt = $this->db->prepare("UPDATE tasks SET title=:title, description=:description, status=:status WHERE id=:id");

        $result = $stmt->execute([...$data, 'id' => $id]);

        var_dump($result);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id=:id");

        $result = $stmt->execute(['id' => $id]);

        var_dump($result);
    }
}
