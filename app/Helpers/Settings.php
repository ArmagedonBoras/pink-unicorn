<?php

namespace App\Helpers;

use Spatie\Valuestore\Valuestore;

class Settings extends Valuestore
{
    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        return $this->put($key, $value);
    }
}
