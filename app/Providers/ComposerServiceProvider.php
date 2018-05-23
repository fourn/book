<?php

namespace App\Providers;

use App\Http\ViewComposers\FooterComposer;
use App\Http\ViewComposers\SetSchoolComposer;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //视图合成器
        view()->composer('layouts._set_school', SetSchoolComposer::class);

        // 使用基于类的 composer...
        View::composer(
            'layouts._footer', FooterComposer::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
