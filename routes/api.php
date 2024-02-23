<?php

use App\Http\Controllers\Api\AssesmentDetailController;
use App\Http\Controllers\Api\AssesmentGroupController;
use App\Http\Controllers\Api\EmrPedodontiController;
use App\Http\Controllers\Api\EmrOrtodonsiController;
use App\Http\Controllers\Api\EmrProstodontieController;
use App\Http\Controllers\Api\EmrKonservasiController;
use App\Http\Controllers\Api\EmrPeriodontieController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\PatientListController;
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

Route::get('reset', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');
});


Route::post("login", [UserController::class, "create"]);

Route::group(["middleware" => ["auth:api", "validate_header"]], function () {

        Route::group(['prefix' => 'v1'], function () {
            Route::group(['prefix' => 'auth'], function () { 
                Route::post("register", [UserController::class, "store"]);
                Route::post("changepassword", [UserController::class, "changepassword"]);
                Route::post("refreshToken", [UserController::class, "refreshToken"]);
                Route::get("viewall", [UserController::class, "showall"]);
                Route::get("viewallallUserswithoutPaging", [UserController::class, "allUserswithoutPaging"]);
                Route::post("update", [UserController::class, "update"]);
                Route::get("view/id/{id}", [UserController::class, "show"]);
                Route::post("profile", [UserController::class, "profile"]);                
                Route::post("logout", [UserController::class, "logout"]);

            });    
            Route::get('kategori-berita', [AssesmentDetailController::class, 'create']);
            Route::group(['prefix' => 'masterdata'], function () { 
                Route::group(['prefix' => 'years'], function () { 
                    Route::post("create", [YearController::class, "store"]);
                    Route::post("update", [YearController::class, "update"]);
                    Route::get("view/id/{id}", [YearController::class, "show"]);
                    Route::get("viewall", [YearController::class, "create"]);
                    Route::get("viewallwithotpaging", [YearController::class, "viewallwithotpaging"]);
                });
                Route::group(['prefix' => 'semesters'], function () { 
                    Route::post("create", [SemesterController::class, "store"]);
                    Route::post("update", [SemesterController::class, "update"]);
                    Route::get("view/id/{id}", [SemesterController::class, "show"]);
                    Route::get("viewall", [SemesterController::class, "create"]);
                    Route::get("viewallwithotpaging", [SemesterController::class, "viewallwithotpaging"]);
                   
                });
                Route::group(['prefix' => 'specialistgroups'], function () { 
                    Route::post("create", [SpecialistGroupController::class, "store"]);
                    Route::post("update", [SpecialistGroupController::class, "update"]);
                    Route::get("view/id/{id}", [SpecialistGroupController::class, "show"]);
                    Route::get("viewall", [SpecialistGroupController::class, "create"]);
                    Route::get("viewallwithotpaging", [SpecialistGroupController::class, "viewallwithotpaging"]);
                });
                Route::group(['prefix' => 'specialists'], function () { 
                    Route::post("create", [SpecialistController::class, "store"]);
                    Route::post("update", [SpecialistController::class, "update"]);
                    Route::get("view/id/{id}", [SpecialistController::class, "show"]); 
                    Route::get("viewall", [SpecialistController::class, "create"]);
                    Route::get("viewallwithotpaging", [SpecialistController::class, "viewallwithotpaging"]);
                });
                Route::group(['prefix' => 'assesmentgroups'], function () { 
                    Route::post("create", [AssesmentGroupController::class, "store"]);
                    Route::post("update", [AssesmentGroupController::class, "update"]); 
                    Route::get("view/id/{id}", [AssesmentGroupController::class, "show"]);
                    Route::get("viewall", [AssesmentGroupController::class, "create"]);
                    Route::get("viewallwithotpaging", [AssesmentGroupController::class, "viewallwithotpaging"]);
                });
                Route::group(['prefix' => 'assesmentdetails'], function () { 
                    Route::post("create", [AssesmentDetailController::class, "store"]);
                    Route::post("update", [AssesmentDetailController::class, "update"]);
                    Route::get("view/id/{id}", [AssesmentDetailController::class, "show"]);
                    Route::get("viewall", [AssesmentDetailController::class, "create"]);
                    Route::get("viewallwithotpaging", [AssesmentDetailController::class, "viewallwithotpaging"]);
                    Route::get("view/groupid/{id}", [AssesmentDetailController::class, "groupid"]);
                });
                Route::group(['prefix' => 'lectures'], function () { 
                    Route::post("create", [LectureController::class, "store"]);
                    Route::post("update", [LectureController::class, "update"]);
                    Route::get("view/id/{id}", [LectureController::class, "show"]);
                    Route::get("viewall", [LectureController::class, "create"]);
                    Route::get("viewallwithotpaging", [LectureController::class, "viewallwithotpaging"]);
                });
                Route::group(['prefix' => 'students'], function () { 
                    Route::post("create", [StudentController::class, "store"]);
                    Route::post("update", [StudentController::class, "update"]);
                    Route::get("view/id/{id}", [StudentController::class, "show"]);
                    Route::get("viewall", [StudentController::class, "create"]); 
                    Route::get("viewallwithotpaging", [StudentController::class, "viewallwithotpaging"]); 
                });
                Route::group(['prefix' => 'hospitals'], function () { 
                    Route::post("create", [HospitalController::class, "store"]);
                    Route::post("update", [HospitalController::class, "update"]);
                    Route::get("view/id/{id}", [HospitalController::class, "show"]);
                    Route::get("viewall", [HospitalController::class, "create"]);
                    Route::get("viewallwithotpaging", [HospitalController::class, "viewallwithotpaging"]);
                });
                Route::group(['prefix' => 'universities'], function () { 
                    Route::post("create", [UniversityController::class, "store"]);
                    Route::post("update", [UniversityController::class, "update"]);
                    Route::get("view/id/{id}", [UniversityController::class, "show"]);
                    Route::get("viewall", [UniversityController::class, "create"]);
                    Route::get("viewallwithotpaging", [UniversityController::class, "viewallwithotpaging"]);
                });
            });
             
            Route::group(['prefix' => 'transaction'], function () {
                Route::group(['prefix' => 'student'], function () {
                });
                Route::group(['prefix' => 'assesment'], function () {
                    Route::post("create", [TransactionAssesmentController::class, "store"]);
                    Route::post("updatedetails", [TransactionAssesmentController::class, "update"]);
                    Route::post("updatedetailsbyitem", [TransactionAssesmentController::class, "updatedetailsbyitem"]);
                    Route::post("viewtrsassesmentheaderbyid", [TransactionAssesmentController::class, "viewtrsassesmentheaderbyid"]);
                    Route::post("viewtrsassesmentdetalbyidandtype", [TransactionAssesmentController::class, "viewtrsassesmentdetalbyidandtype"]);
                    Route::post("detail", [TransactionAssesmentController::class, "show"]);
                });
                Route::group(['prefix' => 'patient'], function () {
                    Route::get("listksmgigi", [PatientListController::class, "create"]);
                    Route::post("listksmgigihistory", [PatientListController::class, "update"]);
                    Route::get("detailbyNoregistrasi/{noreg}", [PatientListController::class, "store"]);
                });
            });
            Route::group(['prefix' => 'emr'], function () {
                Route::group(['prefix' => 'pedodointi'], function () {
                    Route::post("viewemrbyRegOperator", [EmrPedodontiController::class, "update"]);
                    Route::group(['prefix' => 'create'], function () {
                        Route::post("medicaldentalhistory", [EmrPedodontiController::class, "store"]);  
                        Route::post("uploadodontogramfoto", [EmrPedodontiController::class, "uploadfoto"]);  
                    });
                    Route::group(['prefix' => 'behaviorrating'], function () {
                        Route::post("create", [EmrPedodontiController::class, "behaviorratingcreate"]);
                        Route::post("update", [EmrPedodontiController::class, "behaviorratingupdate"]);
                        Route::post("delete", [EmrPedodontiController::class, "behaviorratingdelete"]);
                        Route::post("viewabyId", [EmrPedodontiController::class, "behaviorratingviewbyid"]);
                        Route::post("viewall", [EmrPedodontiController::class, "behaviorratingviewall"]);
                    });
                    Route::group(['prefix' => 'treatment'], function () {
                        Route::post("create", [EmrPedodontiController::class, "treatmentcreate"]);
                        Route::post("update", [EmrPedodontiController::class, "treatmentupdate"]);
                        Route::post("delete", [EmrPedodontiController::class, "treatmentdelete"]);
                        Route::post("viewabyId", [EmrPedodontiController::class, "treatmentviewbyid"]);
                        Route::post("viewall", [EmrPedodontiController::class, "treatmentviewall"]);
                        Route::post("validatesupervisor", [EmrPedodontiController::class, "validatesupervisor"]);
                    });
                    Route::group(['prefix' => 'treatmentplan'], function () {
                        Route::post("create", [EmrPedodontiController::class, "treatmentplancreate"]);
                        Route::post("update", [EmrPedodontiController::class, "treatmentplanupdate"]);
                        Route::post("delete", [EmrPedodontiController::class, "treatmentplandelete"]);
                        Route::post("viewabyId", [EmrPedodontiController::class, "treatmentplanviewbyid"]);
                        Route::post("viewall", [EmrPedodontiController::class, "treatmentplanviewall"]);
                    });
                });
                Route::group(['prefix' => 'ortodonsi'], function () {
                    Route::post("viewemrbyRegOperator", [EmrOrtodonsiController::class, "update"]);
                    Route::group(['prefix' => 'create'], function () {
                        Route::post("medicalwaktuperawatan", [EmrOrtodonsiController::class, "store"]);
                        Route::post("uploadpemeriksaangigi", [EmrOrtodonsiController::class, "uploadfoto"]);  
                    });
                    Route::group(['prefix' => 'analisafoto'], function () {
                        Route::post("uploadtampakdepan", [EmrOrtodonsiController::class, "uploadtampakdepan"]);
                        Route::post("uploadfotosenyum", [EmrOrtodonsiController::class, "uploadfotosenyum"]);  
                        Route::post("uploadfotosamping", [EmrOrtodonsiController::class, "uploadfotosamping"]);  
                        Route::post("uploadfotomiring", [EmrOrtodonsiController::class, "uploadfotomiring"]);  
                    });
                    Route::group(['prefix' => 'geligeli'], function () {
                        Route::post("uploadtampaksampingkanan", [EmrOrtodonsiController::class, "uploadtampaksampingkanan"]);
                        Route::post("uploadtampakdepangeli", [EmrOrtodonsiController::class, "uploadtampakdepangeli"]);  
                        Route::post("uploadtampaksampingkiri", [EmrOrtodonsiController::class, "uploadtampaksampingkiri"]);  
                        Route::post("uploadtampakoklusalatas", [EmrOrtodonsiController::class, "uploadtampakoklusalatas"]);  
                        Route::post("uploadtampakoklusalbawah", [EmrOrtodonsiController::class, "uploadtampakoklusalbawah"]);  
                    });
                    Route::group(['prefix' => 'okulasigigi'], function () {
                        Route::post("uploadmodelstudi", [EmrOrtodonsiController::class, "uploadmodelstudi"]); 
                    });
                    Route::group(['prefix' => 'analisaradiografi'], function () {
                        Route::post("uploadsefalometri", [EmrOrtodonsiController::class, "uploadsefalometri"]); 
                        Route::post("uploadpanoramik", [EmrOrtodonsiController::class, "uploadpanoramik"]); 
                    });
                    Route::group(['prefix' => 'analisaetiologi'], function () {
                        Route::post("uploadanalisaetiologi", [EmrOrtodonsiController::class, "uploadanalisaetiologi"]);  
                    });
                    Route::group(['prefix' => 'jalanperawatan'], function () {
                        Route::post("uploadpencarianruang", [EmrOrtodonsiController::class, "uploadpencarianruang"]);  
                        Route::post("uploadrahangatas", [EmrOrtodonsiController::class, "uploadrahangatas"]);  
                        Route::post("uploadrahangbawah", [EmrOrtodonsiController::class, "uploadrahangbawah"]);  
                    });
                    Route::group(['prefix' => 'retainer'], function () {
                        Route::post("uploadretainer", [EmrOrtodonsiController::class, "uploadretainer"]);   
                    });

                    Route::group(['prefix' => 'desainalat'], function () {
                        Route::post("uploadplakatrahangatas", [EmrOrtodonsiController::class, "uploadplakatrahangatas"]);   
                        Route::post("uploadplakatrahangbawah", [EmrOrtodonsiController::class, "uploadplakatrahangbawah"]);  
                    });

                });
                Route::group(['prefix' => 'prostodonti'], function () {
                    Route::post("viewemrbyRegOperator", [EmrProstodontieController::class, "update"]);
                    Route::group(['prefix' => 'create'], function () {
                        Route::post("medicaldentalhistory", [EmrProstodontieController::class, "store"]);
                        Route::post("medicaldentalhistory", [EmrProstodontieController::class, "store"]);
                        Route::post("uploadgigi", [EmrProstodontieController::class, "uploadfoto"]);   
                    });
                    Route::group(['prefix' => 'logbook'], function () {
                        Route::post("create", [EmrProstodontieController::class, "logbookcreate"]);
                        Route::post("validatelecture", [EmrProstodontieController::class, "validatelecture"]);
                        Route::post("update", [EmrProstodontieController::class, "logbookupdate"]);
                        Route::post("delete", [EmrProstodontieController::class, "logbookdelete"]);
                        Route::post("viewabyId", [EmrProstodontieController::class, "logbookviewbyid"]);
                        Route::post("viewall", [EmrProstodontieController::class, "logbookviewall"]);
                    });
                });
                Route::group(['prefix' => 'konservasi'], function () {
                    Route::post("viewemrbyRegOperator", [EmrKonservasiController::class, "update"]);
                    Route::group(['prefix' => 'create'], function () {
                        Route::post("medicaldentalhistory", [EmrKonservasiController::class, "store"]);
                    });;
                });
                Route::group(['prefix' => 'periodonti'], function () {
                    Route::post("uploadfotopanoramik", [EmrPeriodontieController::class, "uploadfotopanoramik"]);  
                    Route::post("viewemrbyRegOperator", [EmrPeriodontieController::class, "update"]);
                    Route::group(['prefix' => 'create'], function () {
                        Route::post("medicaldentalhistory", [EmrPeriodontieController::class, "store"]); 
                    });
                    Route::group(['prefix' => 'fotoklinisintraoral'], function () {
                        Route::post("upload", [EmrPeriodontieController::class, "uploadfotoklinisintraoral"]);  
                    });
                    Route::group(['prefix' => 'soap'], function () {
                        Route::post("create", [EmrPeriodontieController::class, "createsoap"]);  
                        Route::post("update", [EmrPeriodontieController::class, "updatesoap"]);  
                        Route::post("delete", [EmrPeriodontieController::class, "deletesoap"]);  
                        Route::post("showbyid", [EmrPeriodontieController::class, "showbyidsoap"]);  
                        Route::post("showall", [EmrPeriodontieController::class, "showallsoap"]);  
                        Route::post("verifydpk", [EmrPeriodontieController::class, "verifydpk"]);  
                        
                    });
                });
            });
        });
        
     
});
