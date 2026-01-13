<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Relative extends Model
{
    use HasFactory, LogsActivity;

    protected static $logName = 'relative';
    protected $fillable = ['title', 'image' , 'gender' , 'user_id', 'is_default',];


    protected $appends = ['image_url'];

public function getImageUrlAttribute(): string
{
    if (! $this->image) {
        return rtrim(config('app.media_url'), '/') . '/images/default-relative.png';
    }

    return rtrim(config('app.media_url'), '/') . '/storage/' . ltrim($this->image, '/');
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'gender', 'is_default'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
