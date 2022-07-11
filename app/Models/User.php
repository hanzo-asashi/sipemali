<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('pengguna')
            ->setDescriptionForEvent(fn($eventName) => "{$eventName} pengguna {$this->name}")
            ->logFillable()
            ->logOnlyDirty()
            ;
        // Chain fluent methods for configuration options
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'avatar',
            'nik',
            'name',
            'email',
            'password',
            'status',
            'is_admin',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'is_admin' => 'boolean',
            'status' => 'bool',
        ];

    /**
     * Prepare proper error handling for url attribute.
     *
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        return asset('storage/pengguna/avatar.png') ?: asset('assets/images/users/default.png');
    }

    public function loket(): BelongsTo
    {
        return $this->belongsTo(BranchCounter::class, 'loket_id', 'id');
    }

    /**
     * User relation to info model.
     *
     * @return HasOne
     */
    public function info(): HasOne
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    public function isSuperadmin(): bool
    {
        return auth()->user()->id === 1;
    }

    public function scopeNotSuperadmin($query)
    {
        return $query->where('id', '!=', 1)->where('is_admin', '!=', 1);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 1);
    }

    public function scopeNonAktif($query)
    {
        return $query->where('status', '!=', 1);
    }

    public function scopeWajibPajak($query)
    {
        return $query->where('status', '!=', 1);
    }

//    public function scopeSearch($query, $term)
//    {
//        $term = "%{$term}%";
//        $query->where(function ($q) use ($term) {
//            $q->where('nik', 'like', $term)
//                ->orWhere('name', 'like', $term)
//                ->orWhere('email', 'like', $term)
//                ->orWhere('status', 'like', $term)
//                ->orWhereHas('roles', function ($query) use ($term) {
//                    $query->where('name', 'like', $term);
//                });
//        });
//    }

    public function scopeSearch($query, $term): void
    {
        $term = "%{$term}%";
        $query->where('name', 'like', $term)
            ->orWhere('email', 'like', $term)
            ->orWhere('status', 'like', $term)
            ->orWhereHas('roles', function ($query) use ($term) {
                $query->where('name', 'like', $term);
            })
//            ->orWhereHas('loket', function ($query) use ($term) {
//                $query->where('name', 'like', $term);
//            })
        ;
    }
}
