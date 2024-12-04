<?php

namespace App\Orchid\Filters\Brand;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Brand;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
class BrandFilter extends Filter
{
    public $parameters = ['brand'];

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('id', $this->request->get('brand'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('brand')
                ->empty()
                ->allowEmpty()
                ->fromModel(Brand::where('status','=',1), 'name_'.app()->getLocale(),'id')
                ->placeholder(__("Name",['locale'=>"(ua)"]))
                ->value($this->request->get('brand'))
                ->title(__('Search'))
        ];
    }
}
