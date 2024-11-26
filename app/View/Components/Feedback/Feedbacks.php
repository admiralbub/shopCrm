<?php

namespace App\View\Components\Feedbacks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Feedbacks extends Component
{
    /**
     * Create a new component instance.
     */
    public $feedback;
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.feedback.feedbacks');
    }
}
