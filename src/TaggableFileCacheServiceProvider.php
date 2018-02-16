<?php

namespace Torann\TaggableFileCache;

use Illuminate\Support\ServiceProvider;

class TaggableFileCacheServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app('cache')->extend('tagged_file', function ($app, $config) {
            return app('cache')->repository(
                new TaggableFileStore($app['files'], $config['path'], $config)
            );
        });
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