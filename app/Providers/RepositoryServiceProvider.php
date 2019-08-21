<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\EloquentUserRepository');

        $this->app->bind(
            'App\Repositories\PostRepositoryInterface',
            'App\Repositories\EloquentPostRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductRepositoryInterface',
            'App\Repositories\EloquentProductRepository'
        );

         $this->app->bind(
            'App\Repositories\JobPostingRepositoryInterface',
            'App\Repositories\EloquentJobPostingRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
