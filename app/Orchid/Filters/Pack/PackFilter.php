<?php

namespace App\Orchid\Filters\Pack;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Pack;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
class PackFilter extends Filter
{
    public $parameters = ['pack'];

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('id',$this->request->get('pack'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('pack')

                ->empty()
                ->allowEmpty()
                ->fromModel(Pack::where('status','=',1), 'name_'.app()->getLocale(),'id')
                ->placeholder(__("Name",['locale'=>"(ua)"]))
                ->value($this->request->get('pack'))
                ->title(__('Search'))
        ];
    }
}
