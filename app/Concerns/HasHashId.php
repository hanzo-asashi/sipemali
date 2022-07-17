<?php

namespace App\Concerns;

use Hashids;
use Illuminate\Database\Query\Builder;

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
