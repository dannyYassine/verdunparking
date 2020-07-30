<?php

namespace App\Utils;

class DI
{
    public static function make(...$arguments)
    {
        return app()->make(...$arguments);
    }
}
