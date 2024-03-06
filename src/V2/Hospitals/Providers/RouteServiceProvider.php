<?php

namespace Src\V2\Hospitals\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string|null
     */
    protected $namespace = "Src\\V2\\Hospitals\\Http\\Controllers";

    /**
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {

            Route::prefix("api/v2/master")
            ->middleware("api")
            ->namespace($this->namespace)
            ->group(base_path("src/V2/Hospitals/Routes/api.php"));

            Route::prefix("v2/master")
            ->middleware("web")
            ->namespace($this->namespace)
            ->group(base_path("src/V2/Hospitals/Routes/web.php"));
        });
    }
};
