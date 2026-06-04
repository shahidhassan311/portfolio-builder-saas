<?php

namespace App\View\Components;

use App\Support\Seo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoHead extends Component
{
    /**
     * @param  array<string, mixed>  $seo
     */
    public function __construct(
        public array $seo = [],
        public bool $includePerformanceHints = true,
    ) {
        if (empty($this->seo)) {
            $this->seo = Seo::forRoute();
        }
    }

    public function schemaJson(): ?string
    {
        $graph = Seo::buildSchemaGraph($this->seo);

        if (empty($graph)) {
            return null;
        }

        return Seo::jsonLd($graph);
    }

    public function render(): View|Closure|string
    {
        return view('components.seo-head');
    }
}
