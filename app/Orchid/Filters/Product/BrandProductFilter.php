<?php

namespace App\Orchid\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Product;
use App\Models\Brand;
use Orchid\Screen\Fields\Select;

class BrandProductFilter extends Filter
{
    public function parameters(): array
    {
        return ['brand'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('brand', function (Builder $query) {
            $query->where('brand_id', $this->request->get('brand'));
        });
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
               ->fromModel(Brand::where('status','=',1), 'name_'.app()->getLocale(),'id')
               ->empty()
               ->allowEmpty()
               ->value($this->request->get('brand'))
               ->title(__('Brand')),

       ];
    }
}
