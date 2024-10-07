<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;
use Orchid\Filters\Filterable;
use App\Traits\LocalizationTrait;
class Product extends Model
{
    use LocalizationTrait,HasFactory,AsSource,Sluggable,Filterable;
    protected $fillable = [
        'name_ua',
        'name_ru',
        'h1_ua',
        'h1_ru',
        'meta_title_ua',
        'meta_title_ru',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'image',
        'description_ua',
        'description_ru',
        'brand_id',
        'stock_id',
        'price',
        'price_stock',
        'status',
        'is_new',
        'old_price',
        'is_top',
        'unit',
        'is_recommender',
        'wholesale',
        'is_publish',
        'is_sale',
        'slug',
        'hide_from_categories',
    ];
    protected $allowedSorts = [
        'id',
        'created_at',
        'is_publish'
    ];
    protected $casts = [
        'wholesale' => 'array',
    ];
    public function packs()
    {
        return $this->belongsToMany(Pack::class,'pack_product','product_id','pack_id' );
    }
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name_ua',
                //'onUpdate'=>true
            ]
        ];
    }
    // доступен
    const STATUS_AVAILABLE = 1;
    // снят с производства
    const STATUS_OUT_OF_PRODUCTION = 2;
    // нет в наличии
    const STATUS_UNAVAILABLE = 3;
    // ожидается поставка
    const STATUS_EXPECTED = 4;

    public static function getStatuses() {
        return [
            self::STATUS_AVAILABLE => __('Available'),
            self::STATUS_OUT_OF_PRODUCTION => __('Discontinued'),
            self::STATUS_UNAVAILABLE => __('Out of stock'),
            self::STATUS_EXPECTED => __('Expected delivery'),
        ];
    }
    public function getStatusAvailableAttribute()
    {
        return $this->status === self::STATUS_AVAILABLE;
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function prices()
    {
        return $this->belongsToMany(
            Price::class,
            'price_product',
            'price_id',
            'product_id'
        );
    }
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id'
        );
    }
    public function getWholesaleP3Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p3'] ?? 0) : 0;
    }

    public function getWholesaleP10Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p10'] ?? 0) : 0;
    }
    public function getWholesaleP11Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p11'] ?? 0) : 0;
    }
    public function getWholesaleP12Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p12'] ?? 0) : 0;
    }

    public function getWholesaleP13Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p13'] ?? 0) : 0;
    }
    public function getWholesaleP14Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p14'] ?? 0) : 0;
    }
    public function scopePublished($query)
    {
        return $query->where('is_publish', 1);
    }
   
    public function scopeIsCategory($query)
    {
        return $query->where('hide_from_categories', 0);
    }
}
