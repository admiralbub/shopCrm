<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Traits\LocalizationTrait;
use Cviebrock\EloquentSluggable\Sluggable;
class AttrGroup extends Model
{
    use HasFactory,AsSource,Filterable,LocalizationTrait,Sluggable;

    protected $fillable = [
        'name_ru',
        'name_ua',
        'status'
    ];
    protected $allowedSorts = [
        'id',
        'status'
    ];
    public function attrs()
    {
        return $this->belongsTo(Attr::class);
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