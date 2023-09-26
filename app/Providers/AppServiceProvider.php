<?php

namespace App\Providers;

use App\Models\SiteCommonContent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('frontend::*', function ($view) {
            $site_common_content = SiteCommonContent::first();
            $view->with(compact('site_common_content'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
