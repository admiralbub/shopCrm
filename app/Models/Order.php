<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
		'user_id',
        'id',
		'first_name',
		'last_name',
		'middle_name',
		'phone',
		'email',
		'comment',
        
	];  
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];
    public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function products()
	{
		return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot(['price', 'quantity', 'pack_id','pack_volume']);
	}
}
