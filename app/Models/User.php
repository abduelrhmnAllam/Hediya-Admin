<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
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

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
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
    /**
     * Relation Example - One user has many persons.
     */
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
        return $this->hasMany(\App\Models\UserAddress::class);
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
