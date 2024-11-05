<?php

namespace App\Orchid\Layouts\Brand;

use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use App\Orchid\Filters\Brand\BrandFilter;
class BrandFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public $template = self::TEMPLATE_LINE;
    public function filters(): array
    {
        return [
            BrandFilter::class
        ];
    }
}
