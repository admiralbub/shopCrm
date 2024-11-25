<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Modules\Comments\Entities\Comments;
use Psy\Util\Str;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use App\Traits\LocalizationTrait;
class Stock extends Model
{

    use AsSource,Sluggable,Filterable,LocalizationTrait;

	protected $fillable = [
        'id',
	    'name_ua',
        'name_ru',
        'start_stocks_date',
        'end_stocks_date',
        'slug',
        'h1_ua',
        'h1_ru',
        'meta_title_ua',
        'meta_title_ru',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'img',
        'body_ua',
        'body_ru',
        'status',
        
    ];

    protected $allowedFilters = [
        'id'  => Where::class,
        'status'=> Where::class,
    
    ];

     protected $allowedSorts = [
        'id',
    ];
    protected $appends = [
        'meta_title_parsed',
        'meta_description_parsed',
        'h1_parsed',
    ];
    /**
     * @param $name
     * @param bool $defaultLocaleWhenEmpty
     * @return mixed
     */
 
    public static function boot()
    {
        parent::boot();

 

        static::creating(function ($model) {
          //  $model->title_ru = 'Купить {name} в Украине по лучшей цене от компании Growex';
           // $model->meta_ru = 'Только В магазине Гровекс {name} и другие {category}  лучшего качества, по самой доступной цене в Украине | Growex';
            $model->meta_title_ua = '{name} - купити по акції за вигідною ціною в Zelenijmajster.com';
            $model->meta_title_ru = '{name} - купить по акции по выгодной цене в Zelenijmajster.com';
            $model->meta_description_ua = '{name} - купити по акції від ⏩ Zelenijmajster.com ✅ Знижки ✅100% Оригінал ☎️067 802-17-63';
            $model->meta_description_ru = '{name} - купить по акции от ⏩ Zelenijmajster.com ✅ Скидки ✅100% Оригинал ☎️067 802-17-63';
            $model->h1_ru = '{name}';
            $model->h1_ua = '{name}';
        });
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('start_stocks_date', '<=', Carbon::now())->whereDate('end_stocks_date', '>=', Carbon::now());
    }

    public function getMetaTitleParsedAttribute()
    {
        return str_replace(
            ['{name}'],
            [$this->name],
            $this->meta_title
        );
    }
    public function getMetaDescriptionParsedAttribute()
    {
        return str_replace(
            ['{name}'],
            [$this->name],
            $this->meta_description, 
        );
    }

    public function getH1ParsedAttribute()
    {
        return str_replace(
            ['{name}'],
            [$this->name],
            $this->h1
        );
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
    
}
