<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Illuminate\View\View;

class LegalController extends Controller
{
    public function privacy(): View
    {
        $seo = Seo::forPage('privacy', [
            'canonical' => Seo::canonicalUrl('/privacy'),
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => Seo::siteUrl()],
                ['name' => 'Privacy Policy', 'url' => Seo::canonicalUrl('/privacy')],
            ],
        ]);

        return view('privacy', compact('seo'));
    }

    public function terms(): View
    {
        $seo = Seo::forPage('terms', [
            'canonical' => Seo::canonicalUrl('/terms'),
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => Seo::siteUrl()],
                ['name' => 'Terms & Conditions', 'url' => Seo::canonicalUrl('/terms')],
            ],
        ]);

        return view('terms', compact('seo'));
    }
}
