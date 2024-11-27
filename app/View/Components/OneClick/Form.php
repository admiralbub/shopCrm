<?php

namespace App\View\Components\OneClick;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     */
    public $product;
    public function __construct($product)
    {
        $this->product=$product;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.one-click.form');
    }
}