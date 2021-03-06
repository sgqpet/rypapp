<?php

namespace Sgqpet\Rypapp;

use Illuminate\Support\ServiceProvider;

class RypappServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/views', 'rypapp'); // 视图目录指定
        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/vendor/rypapp'),  // 发布视图目录到resources 下
            __DIR__.'/Middleware' => base_path('app/Http/Middleware'),  // middleware
            __DIR__.'/Config/rypapp.php' => config_path('rypapp.php'), // 发布配置文件到 laravel 的config 下
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rypapp', function ($app) {
            return new rypapp($app['session'], $app['config']);
        });
    }
}
