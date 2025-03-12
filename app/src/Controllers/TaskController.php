<?php

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
