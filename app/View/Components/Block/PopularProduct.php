<?php

namespace App\View\Components\Block;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopularProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public $popularProducts;
    public function __construct($popularProducts)
    {
        $this->popularProducts = $popularProducts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.block.popular-product');
    }
}
