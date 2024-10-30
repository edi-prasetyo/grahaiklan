<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Option;
use App\Models\Page;
use App\Models\Slider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view
                ->with('headers', Slider::where('type', 1)->get())
                ->with('global_categories', Category::all())
                ->with('global_option', Option::first())
                ->with('global_pages', Page::all());
        });
        Paginator::useBootstrapFive();
    }
}
