<?php

namespace App\View\Components\banner;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainSlider extends Component
{
    /**
     * Create a new component instance.
     */
    public $sliders;
    public function __construct($sliders)
    {
        $this->sliders = $sliders;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.banner.main-slider');
    }
}
