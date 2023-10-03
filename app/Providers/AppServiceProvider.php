<?php

namespace App\Providers;

use App\Models\SiteCommonContent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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

        Blade::directive('currencySymbol', function ($money) {
            return "<?php echo \App\Helpers\FrontendHelper::getCurrencySymbol(); ?>";
        });

        Blade::directive('currencyConvertedPrice', function ($money) {
            return "<?php echo \App\Helpers\FrontendHelper::getCurrencyConvertedPrice($money); ?>";
        });

        Blade::directive('currencySymbolWithConvertedPrice', function ($price) {
            return "<?php echo \App\Helpers\FrontendHelper::getCurrencySymbolWithConvertedPrice($price); ?>";
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
