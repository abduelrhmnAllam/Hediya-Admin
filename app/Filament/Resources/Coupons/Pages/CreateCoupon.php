<?php

namespace App\Filament\Resources\Coupons\Pages;

use App\Filament\Resources\Coupons\CouponResource;
use App\Models\Coupon;
use Filament\Resources\Pages\CreateRecord;

class CreateCoupon extends CreateRecord
{
    protected static string $resource = CouponResource::class;

    protected function handleRecordCreation(array $data): Coupon
    {
        return Coupon::updateOrCreate(
            [
                'vendor_id'   => $data['vendor_id'],
                'category_id' => $data['category_id'] ?? null,
            ],
            [
                'vendor_id'   => $data['vendor_id'],
                'category_id' => $data['category_id'] ?? null,
                'coupon'      => $data['coupon'],
                'description' => $data['description'] ?? null,
                'expired_at'  => $data['expired_at'] ?? null,
            ]
        );
    }
}
