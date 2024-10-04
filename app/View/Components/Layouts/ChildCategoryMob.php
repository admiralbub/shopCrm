<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class childCategoryMob extends Component
{
    /**
     * Create a new component instance.
     */
    public $childCategory;
    public function __construct($childCategory)
    {
        $this->childCategory = $childCategory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.child-category-mob');
    }
}
