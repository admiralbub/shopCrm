<?php

namespace App\Orchid\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Category;
use Orchid\Screen\Fields\Select;

class CategoryProductFilter extends Filter
{
    public function parameters(): array
    {
        return ['category'];
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
        return $builder->whereHas('categories', function(Builder $query) {
            $query->where('categories.id', $this->request->get('category'));
        });
    }
    public function display(): array
    {
        return [
             Select::make('category')
                ->fromModel(Category::where('status','=',1), 'name_'.app()->getLocale(),'id')
                ->empty()
                ->allowEmpty()
                ->value($this->request->get('category'))
                ->title(__('Catogories')),

        ];
        
    }
}
