<?php

namespace App\Concerns;

use Illuminate\Database\Query\Builder;

trait HasFilter
{
    public array $filter = [];

    public function getFilter(\Request $request, $field)
    {
        return $request->has($field) ? $request->get($field) : null;
    }

    public function setFilter($key, $value)
    {
        return $this->filter[$key] = $value;
    }

    public function filter(\Request $request, $field)
    {
        $filter = $this->getFilter($request, $field);
        if($filter === 'range'){
            $range = explode(' - ', $filter);
            $start = !is_null($range) ? $range[0] : null;
            $end = !is_null($range) ? $range[1] : null;
            $range = $this->setFilter($field, $filter);
        }
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters = [])
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->{$filter}($query, $value);
            }
        }

        return $query;
    }
}
