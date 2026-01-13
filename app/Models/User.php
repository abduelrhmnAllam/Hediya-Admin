<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
        'avatar_url',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = ['avatar_url'];

    /** 🔗 Avatar full URL */
    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return null;
        }

        return url('uploads/avatars/' . $this->avatar);
    }

    public function persons()
    {
        return $this->hasMany(People::class);
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'user_interest', 'user_id', 'interest_id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function unsignedGifts()
    {
        return $this->hasMany(UnsignedGift::class);
    }

    public function occasions()
    {
        return $this->hasMany(Occasion::class);
    }

    public function memories()
    {
        return $this->hasMany(UserMemory::class);
    }

    public function giftIdeas()
    {
        return $this->hasMany(GiftIdea::class);
    }

    public function productViewHistory()
    {
        return $this->hasMany(ProductViewHistory::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
