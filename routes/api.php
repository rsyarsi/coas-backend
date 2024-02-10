<?php

use App\Http\Controllers\Api\AssesmentDetailController;
use App\Http\Controllers\Api\AssesmentGroupController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\SemesterController;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\SpecialistGroupController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TransactionAssesmentController;
use App\Http\Controllers\Api\UniversityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\YearController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');
});

    Route::post("register", [UserController::class,"store"]);  
    Route::post("login", [UserController::class, "create"]); 

    Route::group(["middleware"=>["auth:api","validate_header"]], function(){

        Route::group(['prefix' => 'v1'], function () {
            Route::group(['prefix' => 'auth'], function () { 
                
                Route::post("genToken", [UserController::class, "genToken"]);
            });    
            Route::get('kategori-berita', [AssesmentDetailController::class, 'create']);
            Route::group(['prefix' => 'masterdata'], function () { 
                Route::group(['prefix' => 'years'], function () { 
                    Route::post("create", [YearController::class, "store"]);
                    Route::post("update", [YearController::class, "update"]);
                    Route::get("view/id/{id}", [YearController::class, "show"]);
                    Route::get("viewall", [YearController::class, "create"]);
                });
                Route::group(['prefix' => 'semesters'], function () { 
                    Route::post("create", [SemesterController::class, "store"]);
                    Route::post("update", [SemesterController::class, "update"]);
                    Route::get("view/id/{id}", [SemesterController::class, "show"]);
                    Route::get("viewall", [SemesterController::class, "create"]);
                   
                });
                Route::group(['prefix' => 'specialistgroups'], function () { 
                    Route::post("create", [SpecialistGroupController::class, "store"]);
                    Route::post("update", [SpecialistGroupController::class, "update"]);
                    Route::get("view/id/{id}", [SpecialistGroupController::class, "show"]);
                    Route::get("viewall", [SpecialistGroupController::class, "create"]);
                });
                Route::group(['prefix' => 'specialists'], function () { 
                    Route::post("create", [SpecialistController::class, "store"]);
                    Route::post("update", [SpecialistController::class, "update"]);
                    Route::get("view/id/{id}", [SpecialistController::class, "show"]); 
                    Route::get("viewall", [SpecialistController::class, "create"]);
                });
                Route::group(['prefix' => 'assesmentgroups'], function () { 
                    Route::post("create", [AssesmentGroupController::class, "store"]);
                    Route::post("update", [AssesmentGroupController::class, "update"]); 
                    Route::get("view/id/{id}", [AssesmentGroupController::class, "show"]);
                    Route::get("viewall", [AssesmentGroupController::class, "create"]);
                });
                Route::group(['prefix' => 'assesmentdetails'], function () { 
                    Route::post("create", [AssesmentDetailController::class, "store"]);
                    Route::post("update", [AssesmentDetailController::class, "update"]);
                    Route::get("view/id/{id}", [AssesmentDetailController::class, "show"]);
                    Route::get("viewall", [AssesmentDetailController::class, "create"]);
                    Route::get("view/groupid/{id}", [AssesmentDetailController::class, "groupid"]);
                });
                Route::group(['prefix' => 'lectures'], function () { 
                    Route::post("create", [LectureController::class, "store"]);
                    Route::post("update", [LectureController::class, "update"]);
                    Route::get("view/id/{id}", [LectureController::class, "show"]);
                    Route::get("viewall", [LectureController::class, "create"]);
                });
                Route::group(['prefix' => 'students'], function () { 
                    Route::post("create", [StudentController::class, "store"]);
                    Route::post("update", [StudentController::class, "update"]);
                    Route::get("view/id/{id}", [StudentController::class, "show"]);
                    Route::get("viewall", [AssesmentDetailController::class, "create"]);
                });
                Route::group(['prefix' => 'hospitals'], function () { 
                    Route::post("create", [HospitalController::class, "store"]);
                    Route::post("update", [HospitalController::class, "update"]);
                    Route::get("view/id/{id}", [HospitalController::class, "show"]);
                    Route::get("viewall", [HospitalController::class, "create"]);
                });
                Route::group(['prefix' => 'universities'], function () { 
                    Route::post("create", [UniversityController::class, "store"]);
                    Route::post("update", [UniversityController::class, "update"]);
                    Route::get("view/id/{id}", [UniversityController::class, "show"]);
                    Route::get("viewall", [UniversityController::class, "create"]);
                });
            });
            Route::group(['prefix' => 'transaction'], function () { 
                Route::group(['prefix' => 'student'], function () { 
    
                }); 
                Route::group(['prefix' => 'assesment'], function () { 
                    Route::post("create", [TransactionAssesmentController::class, "store"]);
                }); 
            });
            Route::group(['prefix' => 'emr'], function () { 
                Route::group(['prefix' => 'periodonti'], function () { 
    
                }); 
                Route::group(['prefix' => 'konservasi'], function () { 
    
                }); 
            });
        });

        
    });
 