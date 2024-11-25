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
        'page_id',
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
        'id',
    ];
    protected $allowedSorts = [
        'id',
        'created_at',
        'is_publish'
    ];
    protected $casts = [
        'wholesale' => 'array',
    ];
    protected $appends = [
        'meta_title_parsed',
        'meta_description_parsed',
        'h1_parsed',

        'name'
    ];
    public function scopeNew($q) {
        $q->where("is_new",1);
    }
    public static function getUnitValuesAttribute()
    {
        return [
            1 => __('liter'),
            2 => __('bag'),
            3 => __('tones'),
            4 => __('kg'),
            5 => __('thing'),
        ];
                            
    }
    public function scopeReccomended($q) {
        $q->where("is_recommender",1);
    }
    public function scopePopular($q) {
        $q->where("is_top",1);
    }

    public function scopeSale($q) {
        $q->where("is_sale",1);
    }
    public function scopeAvailable($q) {
        $q->where("is_publish",1);
    }
    
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

    
    public static function getStatusUnitAttribute() {
        return [
            self::STATUS_AVAILABLE => __('Available'),
            self::STATUS_OUT_OF_PRODUCTION => __('Discontinued'),
            self::STATUS_UNAVAILABLE => __('Out of stock'),
            self::STATUS_EXPECTED => __('Expected delivery'),
        ];
    }
    public function getStatusTextAttribute()
    {
        return $this->status_unit[$this->status];
    }
    public function getUnitStringAttribute()
    {
        return $this->unit_values[$this->unit];
    }
   
    public function getStatusAvailableAttribute()
    {
        return $this->status === self::STATUS_AVAILABLE;
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function stocks()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
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
    public function attrs()
    {
        return $this->belongsToMany(
            Attr::class,
            'attr_product',
            'product_id',
            'attr_id',
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

    
    public static function boot()
    {
        parent::boot();

 

        static::creating(function ($model) {
          //  $model->title_ru = 'Купить {name} в Украине по лучшей цене от компании Growex';
           // $model->meta_ru = 'Только В магазине Гровекс {name} и другие {category}  лучшего качества, по самой доступной цене в Украине | Growex';
            $model->meta_title_ua = '{category} {name} ({pack_name}) - купити в Україні: ціна, інструкція | Zelenijmajster';
            $model->meta_title_ru = '{category} {name} ({pack_name}) - купить в Украине: цена, инструкция | Zelenijmajster';
            $model->meta_description_ua = '{category} {name} ({pack_name}) від {brand} - вигідно купують саме у нас ⏩ Zelenijmajster 💙💛 100% Оригінал ✔️ Оптом і в роздріб';
            $model->meta_description_ru = '{category} {name} ({pack_name}) от {brand} - выгодно покупают именно у нас ⏩ Zelenijmajster 💙💛 100% Оригинал ✔️ Оптом и в розницу';
            $model->h1_ru = '{name} ({pack_name})';
            $model->h1_ua = '{name} - ({pack_name})';
            $model->meta_keywords_ua = 'все про товар {name} Бренд {brand}';
            $model->meta_keywords_ru = 'все о товаре {name} Бренд {brand}';

            
        });
    }
    public function getMetaTitleParsedAttribute()
    {
        
        return str_replace(
            ['{name}', '{category}','{brand}','{pack_name}'],
            [$this->name, $this->showThreeCategory() ?? '',$this->brand->name ?? '',$this->packs->sortBy('pivot.add_time')->first()->title ?? ""],
            $this->meta_title
        );
    }
    public function getMetaDescriptionParsedAttribute()
    {
        return str_replace(
            ['{name}', '{category}','{brand}','{pack_name}'],
            [$this->name, $this->showThreeCategory() ?? '' ?? '', $this->brand->name ?? '',$this->packs->sortBy('pivot.add_time')->first()->title ?? ""],
            $this->meta_description, 
        );
    }
    public function getH1ParsedAttribute()
    {
        return str_replace(
            ['{name}','{pack_name}'],
            [$this->name,$this->packs->first()->name ?? ""],
            $this->h1
        );
    }
    public function showThreeCategory() {
        $cateroris_name = $this->categories->map(
            function ($item) {
                $category = $item->getRootCategory() ?? 0;
                if ($category && $category->parent_id == null) {
                    $category = $item->first();
                }
                if ($category && $category->parent && $category->parent->parent) {
                    if($category->parent->parent->parent) {
                        $category = $category->parent->parent->parent;
                    } else {
                        $category = $category->parent;
                    }
                    
                }
                
                if (!$category) {
                    $category = $item->first();
                }
                return $category;
            });
        return $cateroris_name->first()->name ;
    }
    
}
