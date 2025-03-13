<?php

declare(strict_types=1);

namespace Src\Services;

use Pecee\Http\Request;
use Pecee\Http\Response;
use Src\Repositories\TaskRepository;
use Throwable;

class TaskService
{
    private TaskRepository $repository;
    private Response $response;

    public function __construct()
    {
        $this->repository = new TaskRepository();
        $this->response = new Response(new Request());
    }

    public function create(array $data)
    {
        try {
            $result = $this->repository->create($data);
        } catch (Throwable $throwable) {
            $this->response->httpCode(500)->json([
                'error' => $throwable->getMessage(),
            ]);
        }

        if ($result === false) {
            $this->response->httpCode(500)->json([
                'error' => 'Failed to create task',
            ]);
        }

        $this->response->httpCode(201)->json([
            'message' => 'Task created successfully',
        ]);
    }

    public function read()
    {
        try {
            $data = $this->repository->read();
        } catch (Throwable $throwable) {
            $this->response->httpCode(500)->json([
                'error' => $throwable->getMessage(),
            ]);
        }

        $this->response->httpCode(200)->json((array) $data);
    }

    public function readOne(int $id): void
    {
        try {
            $data = $this->repository->readOne($id);
        } catch (Throwable $throwable) {
            $this->response->httpCode(500)->json([
                'error' => $throwable->getMessage(),
            ]);
        }

        $this->response->httpCode(200)->json((array) $data);
    }

    public function update(int $id, array $data)
    {
        try {
            $result = $this->repository->update($id, $data);
        } catch (Throwable $throwable) {
            $this->response->httpCode(500)->json([
                'error' => $throwable->getMessage(),
            ]);
        }

        if ($result === false) {
            $this->response->httpCode(500)->json([
                'error' => 'Failed to update task',
            ]);
        }

        $this->response->httpCode(200)->json([
            'message' => 'Task updated successfully',
        ]);
    }

    public function delete(int $id)
    {
        try {
            $result = $this->repository->delete($id);
        } catch (Throwable $throwable) {
            $this->response->httpCode(500)->json([
                'error' => $throwable->getMessage(),
            ]);
        }

        if ($result === false) {
            $this->response->httpCode(500)->json([
                'error' => 'Failed to delete task',
            ]);
        }

        $this->response->httpCode(200)->json([
            'message' => 'Task deleted successfully',
        ]);
    }
}
