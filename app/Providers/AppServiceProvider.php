<?php

namespace App\Providers;

use App\Models\CurrencyRate;
use App\Models\SiteCommonContent;
use App\Models\ProductSubCategory;
use App\Models\ProductMainCategory;
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
            $site_menus = ProductSubCategory::whereNull('parent_id')->whereIn('id', $site_common_content->menu_category)->where('status',1)->orderBy('sort_order')->get();
            $currencies = CurrencyRate::active()->get();
            $view->with(compact('site_common_content','site_menus', 'currencies'));
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

        Blade::directive('formattedPrice', function ($price) {
            return "<?php echo \App\Helpers\AdminHelper::getFormattedPrice($price); ?>";
        });

        Blade::directive('checkQuote', function ($price) {
            return "<?php echo \App\Helpers\QuoteHelper::checkQuote(); ?>";
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
