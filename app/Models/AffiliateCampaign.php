<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateCampaign extends Model
{
    protected $fillable = [
        'network_id',
        'vendor_id',
        'external_id',
        'name',
        'logo',
        'currency',
        'status',
        'raw_payload',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    protected $casts = [
        'raw_payload' => 'array',
    ];

    public function network()
    {
        return $this->belongsTo(AffiliateNetwork::class);
    }
}
