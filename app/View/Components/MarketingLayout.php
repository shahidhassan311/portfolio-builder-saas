<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MarketingLayout extends Component
{
    /**
     * @param  array<string, mixed>  $seo
     */
    public function __construct(
        public array $seo = [],
        public ?string $activePage = null,
        public bool $showBreadcrumbs = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.marketing-layout');
    }
}
