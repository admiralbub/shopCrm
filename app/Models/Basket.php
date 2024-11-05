<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quantity',
        'product_id',
        'pack_id'
    ];

    public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
