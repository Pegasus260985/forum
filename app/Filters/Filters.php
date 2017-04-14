<?php

namespace App\Filters;

use function dd;
use Illuminate\Http\Request;
use function method_exists;

abstract class Filters
{

    protected $request, $builder;

    protected $filters = [];

    /**
     * TreadsFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {

        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }

        }

        return $this->builder;

    }

    /**
     * @return array
     */
    protected function getFilters(): array
    {
        return $this->request->intersect($this->filters);
    }
}
