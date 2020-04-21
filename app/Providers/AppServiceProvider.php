<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        Blade::component("craw-header",\App\View\Components\header::class);
        Blade::component("container-row",\App\View\Components\container_row::class);
        Blade::component("craw-footer",\App\View\Components\craw_footer::class);
        Blade::component("navbar1",\App\View\Components\navbar::class);
        Blade::component("navbar2",\App\View\Components\navbar2::class);
    }
}
