<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\LocalizationTrait;
class Brand extends Model
{
    use Sluggable,HasFactory,AsSource,Filterable,LocalizationTrait;

    protected $fillable = [
        'id',
        'h1_ua',
        'h1_ru',
        'name_ru',
        'name_ua',
        'images',
        'description_ru',
        'description_ua',
        'slug',
        'status',
        'meta_description_ru',
        'meta_description_ua',
        'meta_title_ru',
        'meta_title_ua',
        'created_at',
        'meta_keywords_ua',
        'meta_keywords_ru'
    ];
    protected $allowedSorts = [
        'id',
        'status'
    ];
    public function products()
	{
		return $this->hasMany(Product::class);
	}
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name_ua',
               // 'onUpdate'=>true
            ]
        ];
    }
}
