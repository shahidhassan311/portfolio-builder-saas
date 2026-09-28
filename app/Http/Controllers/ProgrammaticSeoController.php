<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgrammaticSeoController extends Controller
{
    public function hub(string $hub): View
    {
        abort_unless(config()->has('seo.programmatic_hubs.'.$hub), 404);

        $pages = config('seo.programmatic_pages.'.$hub, []);
        $seo = Seo::forProgrammaticHub($hub);
        $hubs = array_keys(config('seo.programmatic_hubs', []));

        return view('seo.hub', compact('hub', 'pages', 'seo', 'hubs'));
    }

    public function page(string $hub, string $slug): View
    {
        abort_unless(
            config()->has('seo.programmatic_hubs.'.$hub)
            && config()->has('seo.programmatic_pages.'.$hub.'.'.$slug),
            404
        );

        $seo = Seo::forProgrammaticPage($hub, $slug);
        $related = collect(config('seo.programmatic_pages.'.$hub, []))
            ->except($slug)
            ->take(4);

        return view('seo.page', compact('hub', 'slug', 'seo', 'related'));
    }
}
