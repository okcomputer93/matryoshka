<?php

namespace Okcomputer\Dolly;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Okcomputer\Dolly\BladeDirective;

class DollyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BladeDirective::class, function () {
            return new BladeDirective();
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
            return "<?php if ( ! app('Okcomputer\Dolly\BladeDirective')->setUp({$expression})) { ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } echo app('Okcomputer\Dolly\BladeDirective')->tearDown() ?>";
        });
    }
}
