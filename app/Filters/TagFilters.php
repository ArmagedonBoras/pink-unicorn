<?php

namespace App\Filters;

use Illuminate\Support\Str;

class TagFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['type', 'module', 'group'];

    protected function type($type)
    {
        return $this->builder->where('type', Str::lower($type));
    }

    protected function module($module)
    {
        return $this->builder->where('type', 'like', Str::lower($module).'.%');
    }

    protected function group($group)
    {
        return $this->builder->where('type', 'like', '%.'.Str::lower($group));
    }

}