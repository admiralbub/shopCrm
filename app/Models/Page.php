<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\LocalizationTrait;
use Orchid\Filters\Filterable;
class Page extends Model
{
    use HasFactory,AsSource,LocalizationTrait,Filterable;
    protected $fillable = [
        'id',
        'name_ru',
        'name_ua',
        'description_ua',
        'description_ru',
        'img',
        'url',
        'status',
        'h1_ru',
        'h1_ua',
        'meta_title_ru',
        'meta_title_ua',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'created_at',
    ];
    protected $allowedSorts = [
        'id',
        'status',
    ];
    public function scopeAvailable($q) {
        $q->where("status",1);
    }
}
