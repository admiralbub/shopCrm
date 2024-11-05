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
    public $brand;
    public $category;
    public $price;
    public $attrs;
    public $selectedFilter;
    public function __construct($brand,$category,$price,$attrs,$selectedFilter)
    {
        $this->brand = $brand;
        $this->category = $category;
        $this->price = $price;

        $this->attrs = $attrs;
        $this->attrs = $selectedFilter;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.products.filter');
    }
}
