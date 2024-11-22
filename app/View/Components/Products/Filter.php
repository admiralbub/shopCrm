<?php

namespace App\View\Components\products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    /**
     * Create a new component instance.
     */
    public $brands;
    public $category;
    public $price;
    public $attrs;
    public $selectedFilter;
    public function __construct($brands,$price,$selectedFilter,$attrs,$category)
    {
        $this->brands = $brands;
        $this->category = $category;
        $this->price = $price;

        $this->attrs = $attrs;
        $this->selectedFilter = $selectedFilter;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.products.filter');
    }
}
