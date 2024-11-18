<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
class Order extends Model
{
    use HasFactory,AsSource,Filterable;

    protected $fillable = [
		'id',
		'user_id',
		'first_name',
		'last_name',
		'middle_name',
		'phone',
		'email',
		'comment',
		'total',
		'status',
		'delivery',
		'pay_info',
		'user_id'
        
	];  
	protected $allowedSorts = [
        'id',
        'created_at',
        'is_publish'
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
            ->withPivot(['price', 'quantity']);
	}
	static public function getStatusUnitAttribute()
	{
		return [
			0=>__('New order'),
			1=>__('In progress'),
			2=>__('To pay'),
			3=>__('Paid'),
			4=>__('Sent'),
			5=>__('Cancel order'),

		];
	}
	static public function getDeliverTextAttribute()
	{
		return [
			'NP'=>__('Nova Poshta'),
			//'Urk'=>'Test',
		];
	}
	static public function getPayTextAttribute()
	{
		return [
			'Default_pay'=>__('Payment per hour of picking up the goods'),
		];
	}
	public function getStatusTextAttribute()
    {
        return $this->status_unit[$this->status];
    }
	public function getDeliverNameAttribute()
    {
        return $this->deliver_text[json_decode($this->delivery)->deliver ? json_decode($this->delivery)->deliver ?? '' : ''];
    }

	public function getDeliverTypeAttribute()
    {
        return json_decode($this->delivery)->deliver ? json_decode($this->delivery)->deliver ?? '' : '';
    }
	public function getNpCityAttribute()
    {
        return json_decode($this->delivery)->city_np ? json_decode($this->delivery)->city_np ?? '' : '';
    }

	public function getNpCityRefAttribute()
    {
        return json_decode($this->delivery)->city_ref ? json_decode($this->delivery)->city_ref ?? '' : '';
    }
	public function getNpWarehouseRefAttribute()
    {
        return json_decode($this->delivery)->warehouse_ref ? json_decode($this->delivery)->warehouse_ref ?? '' : '';
    }
	public function getNpWarehouseAttribute()
    {
        return json_decode($this->delivery)->warehouse_np ? json_decode($this->delivery)->warehouse_np ?? '' : '';
    }
	

	public function getPayTypeAttribute()
    {
        return json_decode($this->pay_info)->pay_title ? json_decode($this->pay_info)->pay_title ?? '' : '';
    }
	public function getPayTitleAttribute()
    {
        return $this->pay_text[json_decode($this->pay_info)->pay_title ? json_decode($this->pay_info)->pay_title ?? '' : ''];
    }
}
