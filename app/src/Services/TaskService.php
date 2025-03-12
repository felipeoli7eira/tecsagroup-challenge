<?php

namespace Src\Services;

use Src\Repositories\TaskRepository;

class TaskService
{
    private TaskRepository $repository;

    public function __construct()
    {
        $this->repository = new TaskRepository();
    }

    public function create(array $data)
    {
        $this->repository->create($data);
    }

    public function read()
    {
        $this->repository->read();
    }

    public function update(int $id, array $data)
    {
        $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
    }
}
