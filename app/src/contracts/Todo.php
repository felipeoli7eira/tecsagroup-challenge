<?php

namespace Src\Contracts;

interface Todo
{
    public string $title;
    public string $description;
    public string $status;

    public function getTitle(): string;
    public function getDescription(): string;
    public function getStatus(): string;
}
