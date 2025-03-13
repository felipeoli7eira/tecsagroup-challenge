<?php

declare(strict_types=1);

namespace Src\Controllers;

use Pecee\Http\Input\InputHandler as Input;
use Pecee\Http\Request;
use Src\Services\TaskService;
use Throwable;

class TaskController
{
    private readonly Request $request;
    private readonly Input $input;
    private readonly TaskService $service;

    public function __construct()
    {
        $this->request = new Request();
        $this->input = new Input($this->request);
        $this->service = new TaskService();
    }

    public function renderCreateScreen(): void
    {
        $this->renderView('tasks/create');
    }

    public function renderUpdateScreen(): void
    {
        $this->renderView('tasks/update');
    }

    public function renderHomeScreen(): void
    {
        $this->renderView('tasks/read');
    }

    public function create()
    {
        $this->service->create([
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'status'      => $this->input->post('status')
        ]);
    }

    public function read()
    {
        try {
            $this->service->read();
        } catch (Throwable $throwable) {
            var_dump('can\'t read todo');
        }
    }

    public function readOne(int $id)
    {
        $this->service->readOne($id);
    }

    public function update(int $id)
    {
        $this->service->update($id, [
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'status'      => $this->input->post('status'),
        ]);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
    }

    private function renderView(string $viewName): void
    {
        // Previne que a página seja exibida em um iframe (Clickjacking)
        header('X-Frame-Options: DENY');
        // Previne o navegador de tentar interpretar arquivos como diferentes do tipo MIME declarado
        header('X-Content-Type-Options: nosniff');

        $view = $viewName;
        include_once __DIR__ . '/../views/container.php';
    }
}
