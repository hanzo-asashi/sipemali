<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperUserInfo
 */
class UserInfo extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'avatar',
        'username',
        'first_name',
        'last_name',
        'nop_pbb',
        'tahun_sppt',
        'status_hubungan',
        'domisili',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Get a fullname combination of first_name and last_name.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Prepare proper error handling for url attribute.
     *
     * @return string
     */
//    public function getAvatarAttribute()
//    {
//        // if file avatar exist in storage folder
//        $avatar = public_path(Storage::url($this->avatar));
//        if (is_file($avatar) && file_exists($avatar)) {
//            // get avatar url from storage
//            return Storage::url($this->avatar);
//        }
//
//        // check if the avatar is an external url, eg. image from google
//        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
//            return $this->avatar;
//        }
//
//        // no avatar, return blank avatar
//        return asset('/assets/images/users/avatar-1.jpg');
//    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->singleFile();
    }

    /**
     * User info relation to user model.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Unserialize values by default.
     *
     * @param $value
     * @return mixed|null
     */
    public function getCommunicationAttribute($value): mixed
    {
        // test to un-serialize value and return as array
        $data = @unserialize($value);
        if ($data !== false) {
            return $data;
        }

        return null;
    }
}
