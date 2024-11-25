<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stock extends Component
{
    /**
     * Create a new component instance.
     */
    public $stock;
    public $lang;
    public function __construct($stock,$lang)
    {
        $this->stock = $stock;
        $this->lang = $lang;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stock.stock');
    }
}
