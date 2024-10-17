<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Traits\LocalizationTrait;

class Attr extends Model
{
    use HasFactory,AsSource,Filterable,LocalizationTrait;

    protected $fillable = [
        'name_ru',
        'name_ua',
        'status',
        'group_id'
    ];
    protected $allowedSorts = [
        'id',
        'status'
    ];

    public function attrGroup()
	{
		return $this->hasMany(AttrGroup::class,'id','group_id');
	}
}
