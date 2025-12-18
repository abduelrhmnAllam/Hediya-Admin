<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon'];


    protected $appends = ['icon_url'];

    public function people()
    {
        return $this->belongsToMany(People::class, 'person_interest', 'interest_id', 'person_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_interest', 'interest_id', 'user_id');
    }


    public function getIconUrlAttribute(): string
{
    if ($this->icon) {
        return rtrim(config('app.media_url'), '/') . '/storage/' . ltrim($this->icon, '/');
    }

    return rtrim(config('app.media_url'), '/') . '/images/default-interest.png';
}

}
