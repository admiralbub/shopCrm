<?php

namespace App\Orchid\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Product;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
class NameProductFilter extends Filter
{
    public $parameters = ['product'];

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('id', $this->request->get('product'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('product')

                ->empty()
                ->allowEmpty()
                ->fromModel(Product::where('status','=',1), 'name_'.app()->getLocale(),'id')
                ->placeholder(__("Name",['locale'=>"(ua)"]))
                ->value($this->request->get('product'))
                ->title(__('Search'))
        ];
    }
}
