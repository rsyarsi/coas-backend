<?php

namespace App\Providers;

use App\Repositories\Interfaces\YearRepositoryInterface;
use App\Repositories\YearRepository;
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
        $this->app->bind(YearRepositoryInterface::class, YearRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
