<?php

namespace App\Orchid\Filters\Brand;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Brand;
use Orchid\Screen\Fields\Input;
class BrandFilter extends Filter
{
    public $parameters = ['name_ua'];

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('name_ua', 'LIKE', "%{$this->request->get('name_ua')}%");
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Input::make('name_ua')
                ->type('text')
                ->value($this->request->get('name_ua'))
                ->placeholder(__("Name",['locale'=>"(ua)"]))
                ->title(__('Search'))
        ];
    }
}
