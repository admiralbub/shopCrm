<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\LocalizationTrait;

class Attr extends Model
{
    use Sluggable,HasFactory,AsSource,Filterable,LocalizationTrait;

    protected $fillable = [
        'name_ru',
        'name_ua',
        'status',
        'group_id',
        'group',
        'slug'
    ];
    public static function getGroupUnitAttribute() {
        return [
            'cult' => __('Analog'),
            'analog' => __('Culture'),
            'sub' =>__('Active ingredient')
        ];
    }
    public function getGroupTextAttribute()
    {
        return $this->group_unit[$this->group];
    }

    protected $allowedSorts = [
        'id',
        'status'
    ];

  
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
