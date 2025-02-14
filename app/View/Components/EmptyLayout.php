<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyLayout extends Component
{
    public function render(): View
    {
        return view('components.layouts.empty');
    }
}
