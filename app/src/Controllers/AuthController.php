<?php

declare(strict_types=1);

namespace Src\Controllers;

use Pecee\Http\Input\InputHandler as Input;
use Pecee\Http\Request;
use Pecee\Http\Response;

class AuthController
{
    private readonly Request $request;
    private readonly Response $response;

    private readonly Input $input;

    public function __construct()
    {
        $request = new Request();

        $this->request = $request;
        $this->response = new Response($request);

        $this->input = new Input($request);
    }

    public function login() {}

    public function logout() {}
}
