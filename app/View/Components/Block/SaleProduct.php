<?php

namespace App\View\Components\Block;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SaleProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public $saleProducts;
    public function __construct($saleProducts)
    {
        $this->saleProducts = $saleProducts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.block.sale-product');
    }
}
