<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Relative extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image' , 'gender' , 'user_id', 'is_default',];


    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-relative.png');
    }
     public function persons()
    {
        return $this->hasMany(Person::class);
    }

    public function scopeVisibleForUser($query, $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('is_default', 1)
              ->orWhere('user_id', $userId);
        });
    }
    
    public function scopeSearch($query, $term)
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where('title', 'LIKE', "%{$term}%");
        });
    }

}
