<?php

namespace Src\Services;

use Pecee\Http\Request;
use Pecee\Http\Response;
use Src\Repositories\TaskRepository;

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
        $result = $this->repository->create($data);

        if (! $result) {
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
        $data = $this->repository->read();
        $this->response->httpCode(200)->json($data);
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
