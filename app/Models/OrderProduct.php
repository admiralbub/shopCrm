<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
class OrderProduct extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
    ];
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public function pack()
    {
        return $this->belongsTo(Pack::class, 'pack_id', 'id');
    }
}
