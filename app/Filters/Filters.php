<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * The Eloquent builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Create a new ThreadFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters.
     *
     * @param  Builder $builder
     * @param  Array   $always
     * @return Builder
     */
    public function apply($builder, array $always = [])
    {
        $this->builder = $builder;
        $filters = array_merge ($always, $this->getFilters());
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return Builder
     */
    protected function created_by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('created_by', $user->id);
    }

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return Builder
     */
    protected function updated_by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('created_by', $user->id);
    }
}