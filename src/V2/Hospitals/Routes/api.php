<?php

use Src\V2\Hospitals\Http\Controllers\API\HospitalController;
use Illuminate\Support\Facades\Route;

Route::get("/hospitals/select", [ HospitalController::class, "select", ]);
Route::match([ "put", "patch" ], "hospitals/activate/{id}", [ HospitalController::class, "activate", ]);
Route::match([ "put", "patch" ], "hospitals/deactivate/{id}", [ HospitalController::class, "deactivate", ]);
Route::apiResource("/hospitals", HospitalController::class)->parameters([ "hospitals" => "id", ]);
