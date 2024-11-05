<?php

namespace App\Orchid\Layouts\Product;

use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use App\Orchid\Filters\Product\NameProductFilter;
use App\Orchid\Filters\Product\CategoryProductFilter;
use App\Orchid\Filters\Product\BrandProductFilter;
class ProductFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public $template = self::TEMPLATE_LINE;
    public function filters(): iterable
    {
        return [
            NameProductFilter::class,
            BrandProductFilter::class,
            CategoryProductFilter::class
        ];
    }
}
