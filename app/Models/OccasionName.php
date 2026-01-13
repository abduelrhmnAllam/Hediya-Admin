<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OccasionName extends Model
{
    use HasFactory, LogsActivity;

    protected static $logName = 'occasion';


    protected $fillable = [
    'name',
    'description',
    'image_background',
    'background_color',
    'title_color',
    'is_default',
    'is_recommend',
    'date',
    'user_id',
];


    public function occasions()
    {
        return $this->hasMany(Occasion::class, 'occasion_name_id');
    }
    protected $appends = ['image_background_url'];

 public function getImageBackgroundUrlAttribute(): ?string
{
    if (! $this->image_background) {
        return null;
    }

    return rtrim(config('app.media_url'), '/') . '/storage/' . ltrim($this->image_background, '/');
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
            $q->where('name', 'LIKE', "%{$term}%");
        });
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'description',
                'background_color',
                'title_color',
                'is_default',
                'is_recommend',
                'date',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    
}
