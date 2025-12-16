<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'label',
        'recipient_name',
        'recipient_phone',
        'country',
        'city',
        'area',
        'street',
        'building',
        'floor',
        'apartment',
        'postal_code',
        'directions',
        'nearby_landmark',
        'lat',
        'lng',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
