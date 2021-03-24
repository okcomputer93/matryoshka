<?php

namespace Okcomputer\Matryoshka;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Okcomputer\Matryoshka\BladeDirective;
use Okcomputer\Matryoshka\RussianCaching;
use Illuminate\Contracts\Cache\Repository as Cache;

class MatryoshkaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BladeDirective::class, function () {
            return new BladeDirective(
                new RussianCaching(
                    app(Cache::class)
                )
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function ($expression) {
            return "<?php if ( ! app('Okcomputer\Matryoshka\BladeDirective')->setUp({$expression})) { ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } echo app('Okcomputer\Matryoshka\BladeDirective')->tearDown() ?>";
        });
    }
}
