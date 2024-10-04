<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class childCategory extends Component
{
    public $childCategory;
    /**
     * Create a new component instance.
     */
    public function __construct($childCategory)
    {
        $this->childCategory = $childCategory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.layouts.child-category');
    }
}
