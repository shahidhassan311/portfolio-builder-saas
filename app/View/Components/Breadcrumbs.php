<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    /**
     * @param  array<int, array{name: string, url?: string}>  $items
     */
    public function __construct(
        public array $items = [],
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.breadcrumbs');
    }
}
