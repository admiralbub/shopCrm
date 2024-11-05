<?php

namespace App\Orchid\Layouts\Pack;

use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use App\Orchid\Filters\Pack\PackFilter;
class PackFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public $template = self::TEMPLATE_LINE;
    public function filters(): iterable
    {
        return [
            PackFilter::class
        ];
    }
}
