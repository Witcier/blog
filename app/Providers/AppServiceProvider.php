<?php

namespace App\Providers;

use App\Models\Admin\Config;
use Illuminate\Support\ServiceProvider;

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
        \Schema::defaultStringLength(191);
        Config::loadAllConfig();
        \View::composer([
            'about.index', 'blog.index', 'guestbook.index', 'navigation.index', 'wiki.index', 'welcome.index'
        ], \App\Http\ViewComposers\NavMenuComposer::class);
    }
}
