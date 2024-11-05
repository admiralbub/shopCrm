<?php

namespace App\Orchid\Layouts\Price;

use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use App\Orchid\Filters\Price\PriceFilter;
class PriceFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public $template = self::TEMPLATE_LINE;
    public function filters(): iterable
    {
        return [
            PriceFilter::class
        ];
    }
}
