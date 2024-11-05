<?php

namespace App\Orchid\Filters\Price;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Price;
use Orchid\Screen\Fields\Input;

class PriceFilter extends Filter
{
    public $parameters = ['name_ua'];

    /**
     * The array of matched parameters.
     *
     * @return array|null
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
