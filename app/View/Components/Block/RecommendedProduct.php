<?php

namespace App\View\Components\Block;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecommendedProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public $recommendedProducts;
    public function __construct($recommendedProducts)
    {
        $this->recommendedProducts = $recommendedProducts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.block.recommended-product');
    }
}
