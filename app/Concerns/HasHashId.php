<?php

namespace App\Concerns;


use Illuminate\Database\Query\Builder;
use Hashids;

trait HasHashId
{
    public function scopeByHashId(Builder $query, string $hash)
    {
        $query->where('id', '=', Hashids::decode($hash)[0]);
    }

    public function findByHashId(string $hash)
    {
        return Hashids::decode($hash)[0];
    }
}
