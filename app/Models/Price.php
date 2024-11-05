<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
class Price extends Model
{
    use HasFactory,AsSource,Filterable;
    protected $fillable = [
        'id',
        'price',
        'name_ua',
        'name_ru',
        'status'
    ];
    protected $allowedSorts = [
        'id',
        'status'
    ];
}
