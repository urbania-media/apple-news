<?php

namespace Urbania\AppleNews\Laravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class AppleNewsServiceProvider extends BaseServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected function getRouter()
    {
        return $this->app['router'];
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootPublishes();
    }

    public function bootPublishes()
    {
        // Config file path
        $configPath = __DIR__ . '/config.php';
        $viewsPath = __DIR__ . '/resources/views/';
        $langPath = __DIR__ . '/resources/lang/';

        // Merge files
        $this->mergeConfigFrom($configPath, 'apple-news');

        // Publish
        $this->publishes([
            $configPath => config_path('apple-news.php')
        ], 'config');

        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/folklore/apple-news')
        ], 'views');

        $this->publishes([
            $langPath => base_path('resources/lang/vendor/folklore/apple-news')
        ], 'lang');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
