<?php

namespace App\View\Components\Block;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewProduct extends Component
{
    /**
     * Create a new component instance.
     */

    public $newProduct;
    public function __construct($newProduct)
    {
        $this->newProduct = $newProduct;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.block.new-product');
    }
}
