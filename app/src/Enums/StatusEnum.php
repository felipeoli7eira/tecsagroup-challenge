<?php

namespace Src\Enums;

enum StatusEnum: string
{
    case do = 'do';
    case doing = 'doing';
    case done = 'done';

    public function value(): string
    {
        return $this->value;
    }

    public static function casesMapArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
