<?php

declare(strict_types=1);

namespace Src\Services;

use Pecee\Http\Request;
use Pecee\Http\Response;
use Src\Enums\StatusEnum;
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

    public function validateInput(array $data, array $options): bool
    {
        if (! $options['title_is_nullable']) {
            // * title validations
            if (!isset($data['title'])) {
                return false;
            }

            if (empty($data['title']?->value)) {
                return false;
            }

            if (gettype($data['title']->value) !== "string") {
                return false;
            }

            if (strlen($data['title']->value) > 255) {
                return false;
            }

            if (strlen($data['title']->value) < 1) {
                return false;
            }
        }

        if (! $options['description_is_nullable']) {
            // * description validations
            if (! isset($data['description'])) {
                return false;
            }

            if (empty($data['description']?->value)) {
                return false;
            }

            if (gettype($data['description']->value) !== "string") {
                return false;
            }

            if (strlen($data['description']->value) > 255) {
                return false;
            }

            if (strlen($data['description']->value) < 3) {
                return false;
            }
        }

        if (! $options['status_is_nullable']) {
            // * status validation
            if (! isset($data['status'])) {
                return false;
            }

            if (empty($data['status']?->value)) {
                return false;
            }

            if (! in_array($data['status']?->value, StatusEnum::casesMapArray())) {
                return false;
            }

            if (gettype($data['status']->value) !== "string") {
                return false;
            }
        }

        return true;
    }

    public function sanitizeInput(array $data): array
    {
        if (isset($data['title']) && $data['title']?->value !== null) {
            $data['title']->value = trim($data['title']->value);
            $data['title']->value = htmlspecialchars($data['title']->value, ENT_QUOTES, 'UTF-8');
        }

        if (isset($data['description']) && $data['description']?->value !== null) {
            $data['description']->value = trim($data['description']->value);
            $data['description']->value = htmlspecialchars($data['description']->value, ENT_QUOTES, 'UTF-8');
            $data['description']->value = filter_var($data['description']->value, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (isset($data['status']) && $data['status']?->value !== null) {
            $data['status']->value = trim($data['status']->value);
            $data['status']->value = htmlspecialchars($data['status']->value, ENT_QUOTES, 'UTF-8');
        }

        return $data;
    }

    public function create(array $data)
    {
        if (! $this->validateInput($data, [
            'title_is_nullable'       => false,
            'description_is_nullable' => false,
            'status_is_nullable'      => false,
        ])) {
            return $this->response->httpCode(400)->json(['error' => 'Invalid data', 'data' => $data]);
        }

        try {
            $data = $this->sanitizeInput($data);

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
        if (is_null($data['title']?->value) && is_null($data['description']?->value) && is_null($data['status']?->value)) {
            return $this->response->httpCode(200)->json(['message' => 'Nothing to update']);
        }

        if (! $this->validateInput($data, [
            'title_is_nullable'       => $data['title']?->value       === null,
            'description_is_nullable' => $data['description']?->value === null,
            'status_is_nullable'      => $data['status']?->value      === null,
        ])) {
            return $this->response->httpCode(400)->json(['error' => 'Invalid data', 'data' => $data]);
        }

        $data = array_filter($data, fn($value) => $value !== null);

        try {
            $sanitizedData = $this->sanitizeInput($data);

            $result = $this->repository->update($id, $sanitizedData);
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
