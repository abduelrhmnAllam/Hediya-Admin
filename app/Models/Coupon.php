<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Coupon extends Model
{
    use LogsActivity;

    protected static $logName = 'coupon';

    protected $fillable = [
        'vendor_id',
        'category_id',
        'coupon',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

      public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['vendor_id', 'category_id', 'coupon'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

