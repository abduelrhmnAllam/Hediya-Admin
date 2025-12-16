<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'supplier_guid',
        'name',
        'slug',
        'parent_id',
        'vendor_id',
        'extra',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_assets', 'asset_id', 'product_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
