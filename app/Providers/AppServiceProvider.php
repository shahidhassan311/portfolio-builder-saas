<?php

namespace App\Providers;

use App\Support\Seo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('themes.*', function ($view): void {
            if (str_contains($view->getName(), 'partials') || str_contains($view->getName(), '-cv-pdf')) {
                return;
            }

            $user = $view->getData()['user'] ?? null;
            $isPreview = $view->getData()['isPreview'] ?? false;

            if (! $user) {
                return;
            }

            $id = request()->route('id') ?? $user->id ?? 0;
            $username = request()->route('username') ?? $user->username ?? 'portfolio';
            $path = '/'.$id.'/'.$username;

            $view->with('portfolioSeo', Seo::forPortfolio(
                $user->name ?? 'Portfolio',
                $path
            ) + [
                'robots' => $isPreview ? 'noindex, nofollow' : 'noindex, follow',
            ]);
        });

        View::composer(['layouts.app', 'layouts.guest'], function ($view): void {
            $view->with('seo', Seo::forRoute());
        });
    }
}
