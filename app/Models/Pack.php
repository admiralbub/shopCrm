<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Screen\Actions\Link;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use App\Traits\LocalizationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Pack extends Model
{
    use LocalizationTrait,AsSource,Filterable,HasFactory;
    protected $fillable = [
        'volume',
        'name_ru',
        'name_ua',
        'status'
    ];



    protected $allowedFilters = [
        'id'  => Where::class,
        'title_ua'=> Where::class,
    
    ];

     protected $allowedSorts = [
        'id',
    ];
    protected $lang_fields = [
        'title',
    ];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    
    public function getTitleAttribute()
    {
        return $this->getLocalizedAttr('title');
    }


    public function getLocalizedAttrName($name)
    {
        return $name . '_' . app()->getLocale();
    }

    /**
     * @param $name
     * @param bool $defaultLocaleWhenEmpty
     * @return mixed
     */
    public function getLocalizedAttr($name, $defaultLocaleWhenEmpty = false)
    {
        $attr = $this->getAttribute($this->getLocalizedAttrName($name));

        if (empty($attr) && $defaultLocaleWhenEmpty) {
            $attr = $this->getAttribute($name . '_' . config()->get('app.fallback_locale'));
        }

        return $attr;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'pack_product', 'pack_id', 'product_id')
            ->withPivot('add_time');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'pack_id', 'id');
    }

    /**
     * @return mixed
     */
    
}
