<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @mixin IdeHelperRole
 */
class Role extends SpatieRole
{
    public function scopeSearch($query, $term): void
    {
        $term = "%{$term}%";
        $query->where(function ($q) use ($term) {
            $q->where('name', 'like', $term)
        ->orWhereHas('permissions', function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
        });
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'id');
    }
}
