<?php

declare(strict_types=1);

namespace Src\Controllers;

use Pecee\Http\Input\InputHandler as Input;
use Pecee\Http\Request;
use Src\Services\TaskService;
use Throwable;

enum Status: string
{
    case do = 'A fazer';
    case doing = 'Fazendo';
    case done = 'Feito';

    public function value(): string
    {
        return $this->value;
    }
}

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

    public function renderCreateTaskPage(): void
    {
        $view = '/tasks/create';
        include_once __DIR__ . '/../views/view.php';
    }

    public function renderEditTaskPage(int $id): void
    {
        $view = '/tasks/edit';
        $data = $this->service->readOne($id);

        $data->friendlyStatus = match ($data->status) {
            'do'    => Status::do->value(),
            'doing' => Status::doing->value(),
            'done'  => Status::done->value(),
        };

        include_once __DIR__ . '/../views/view.php';
    }

    public function renderHomePage(): void
    {
        $view = '/tasks/list';
        include_once __DIR__ . '/../views/view.php';
    }

    public function create()
    {
        try {
            $this->service->create([
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status'      => $this->input->post('status', 'todo')
            ]);
        } catch (Throwable $throwable) {
            var_dump('can\'t create todo');
        }
    }

    public function read()
    {
        try {
            $this->service->read();
        } catch (Throwable $throwable) {
            var_dump('can\'t read todo');
        }
    }

    public function update(int $id)
    {
        $this->service->update($id, [
            'title'       => $this->input->post('title')->value,
            'description' => $this->input->post('description')->value,
            'status'      => $this->input->post('status', 'todo')->value,
        ]);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
    }
}
