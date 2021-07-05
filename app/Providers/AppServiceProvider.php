<?php

namespace App\Providers;

use App\Models\Admin\Config;
use Dcat\Admin\Admin;
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
        if (\Schema::hasTable((new Config)->getTable())) {
            Config::loadAllConfig();
        }
        \View::composer([
            'about.index', 'blog.index', 'guestbook.index', 'navigation.index', 'wiki.index', 'wiki.detail.index', 'xmind.index'
        ], \App\Http\ViewComposers\NavMenuComposer::class);
        Admin::favicon(config('user_avatar'));
    }
}
