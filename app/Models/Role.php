<?php

namespace App\Models;

/**
 * @mixin IdeHelperRole
 */
class Role extends \Spatie\Permission\Models\Role
{
    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where(function ($q) use ($term) {
            $q->where('name', 'like', $term)
        ->orWhereHas('permissions', function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
        });
    }
}
