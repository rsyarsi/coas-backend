<?php

namespace App\Providers;

use App\Repositories\EmrPedodontiRepository;
use App\Repositories\Interfaces\EmrPedodontiRepositoryInterface;
use App\Repositories\EmrOrtodonsiRepository;
use App\Repositories\Interfaces\EmrOrtodonsiRepositoryInterface;

use App\Repositories\Interfaces\YearRepositoryInterface;
use App\Repositories\YearRepository;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Tripteki\RequestResponseQuery\Providers\RequestResponseQueryServiceProvider::ignoreConfig();
        \Tripteki\ImportExport\Providers\ImportExportServiceProvider::ignoreConfig();
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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}
