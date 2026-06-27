<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    public const DIR_IMAGE_UPLOADS = 'users';

    protected $appends = [
        'image300',
        'first_name',
        'last_name',
        'slug',
        'verify_account',
    ];

    protected $guarded = [];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.' . $this->id;
    }

    public function getVerifyAccountAttribute()
    {
        $status = true;
        if (is_null($this->email_verified_at) && is_null($this->mobile_verified_at))
            $status = false;
        return $status;
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->full_name) . '-' . $this->uniq_id;
    }

    public function getFirstNameAttribute($value)
    {
        $fullName = explode(' ', $this->full_name);

        return isset($fullName[0]) ? $fullName[0] : '';
    }

    public function getLastNameAttribute($value)
    {
        $fullName = explode(' ', $this->full_name);

        $lastName = isset($fullName[1]) ? $fullName[1] : '';

        if (isset($fullName[1]) && isset($fullName[2]))
            $lastName = $fullName[1] . ' ' . $fullName[2];

        return isset($lastName) ? $lastName : '';
    }


    public function getImage300Attribute()
    {
        $defaultImage = user_default();

        if (aws_is_s3()) {
            $userImage = aws_cnd_url(DIR_UPLOAD(self::DIR_IMAGE_UPLOADS . '/' . WITH_300 . '/' . $this->image));
        } else {
            $userImage = assetUpload(self::DIR_IMAGE_UPLOADS . '/' . WITH_300 . '/' . $this->image);
        }

        return $this->image ? $userImage : $defaultImage;
    }


    public function scopeUserTypeAdmin($query)
    {
        return $query->where('user_type_id', UserType::ADMIN);
    }

    public function scopeUserTypeCustomer($query)
    {
        return $query->where('user_type_id', UserType::NORMAL);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', UserStatus::ACCEPTED);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function status()
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }

}
