<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'external_id',
        'brand_id',
        'vendor_id',
        'name',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'fingerprint',
        'master_sku',
        'short_description',
        'long_description',
        'description',
        'material',
        'gender_en',
        'gender_ar',
        // 'attributes',   // removed (Laravel reserved name)
        'category_id',
        'currency',
        'price',
        'old_price',
        'qty',
        'url',
        'colors_en',
        'colors_ar',
        'sizes_en',
        'sizes_ar',
        'version',
        'vendor_id',
        'country_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function giftlist()
    {
        return $this->hasMany(GiftList::class, 'product_id');
    }

    public function unsignedGiftlist()
    {
        return $this->hasMany(UnsignedGift::class, 'product_id');
    }


    public function giftedTo()
    {
        return $this->belongsToMany(People::class, 'gift_list', 'product_id', 'person_id')
            ->withPivot('user_id')
            ->withTimestamps();
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get coupon for this product through vendor
     * 
     * @return Coupon|null
     */
    public function getCoupon()
    {
        if (!$this->vendor_id) {
            return null;
        }

        return Coupon::where('vendor_id', $this->vendor_id)->first();
    }


    /**
     * Get the embedding relationship for this product
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function embedding()
    {
        return $this->hasOne(ProductEmbedding::class);
    }

    /**
     * Get the product with full information
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithFullInfo($query)
    {
        return $query->with(['category:id,name,slug,parent_id', 'images:id,url,product_id', 'brand:id,name' ,'vendor:id,name', 'country:id,name,code'])
            ->withExists('giftlist')->withExists('unsignedGiftlist');
    }

    /**
     * Order products by embedding similarity using cosine distance
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $embedding The embedding vector to compare against
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByEmbedding($query, array $embedding)
    {
        $vectorString = '[' . implode(',', $embedding) . ']';
        
        // Join with product_embeddings and only include products that have embeddings
        // Use leftJoin to preserve products without embeddings if needed, or inner join to exclude them
        return $query->join('product_embeddings', 'products.id', '=', 'product_embeddings.product_id')
            ->whereNotNull('product_embeddings.embedding')
            ->orderByRaw('product_embeddings.embedding <-> ?::vector', [$vectorString]);
    }   
}
