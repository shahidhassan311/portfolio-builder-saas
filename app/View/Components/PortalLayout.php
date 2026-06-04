<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PortalLayout extends Component
{
    public function __construct(
        public string $active = 'overview',
        public string $title = 'Dashboard',
        public ?string $description = null,
    ) {}

    public function render(): View
    {
        return view('components.portal-layout');
    }
}
