<?php

namespace App\Providers;

use App\Repositories\EmrPedodontiRepository;
use App\Repositories\Interfaces\EmrPedodontiRepositoryInterface;
use App\Repositories\EmrOrtodonsiRepository;
use App\Repositories\Interfaces\EmrOrtodonsiRepositoryInterface;

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
        $this->app->bind(EmrPedodontiRepositoryInterface::class, EmrPedodontiRepository::class);
        $this->app->bind(EmrOrtodonsiRepositoryInterface::class, EmrOrtodonsiRepository::class);
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
