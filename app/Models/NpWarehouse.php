<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NpWarehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'Description',
        'DescriptionRu',
        'Ref',
        'CityRef'
    ];

    public function scopeRef($q, $id) {
        $ref = NpCity::where('id',$id)->pluck('Ref')->first();
        $q->where("CityRef",$ref);
    }
}
