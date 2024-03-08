<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AssesmentGroupFinalRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;

class AssesmentGroupFinalService extends Controller
{ 
    private $AssesmentGroupFinalRepository;

    public function __construct( 
        AssesmentGroupFinalRepositoryInterface $AssesmentGroupFinalRepository
        
        )
    { 
        $this->AssesmentGroupFinalRepository = $AssesmentGroupFinalRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "name" => "required",  
            "active" => "required" ,
            "specialistid" => "required",  
            "bobotvaluefinal" => "required",  
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'name' => $request->name, 
                'active' => $request->active ,
                'specialistid' => $request->specialistid,
                'bobotvaluefinal' => $request->bobotvaluefinal,
            ];

            $execute = $this->AssesmentGroupFinalRepository->storeAssesmentGroupFinal($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Group Penilaian Akhir Berhasil dibuat !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function update(Request $request)
    {
        $request->validate([ 
            "name" => "required",  
            "active" => "required" ,
            "specialistid" => "required",  
            "bobotvaluefinal" => "required",  
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->AssesmentGroupFinalRepository->findAssesmentGroupFinal($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Group Penilaian Akhir tidak ditemukan !',[]);
            }

             
            $data = [
                'id' => $request->id,         
                'name' => $request->name, 
                'active' => $request->active,
                'specialistid' => $request->specialistid,
                'bobotvaluefinal' => $request->bobotvaluefinal,
            ];
            $execute = $this->AssesmentGroupFinalRepository->updateAssesmentGroupFinal($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Group Penilaian Final Berhasil diupdate !');
            }

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function show($id)
    {
        try {
            
            $find = $this->AssesmentGroupFinalRepository->findAssesmentGroupFinal($id); 
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian Final tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');

        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->AssesmentGroupFinalRepository->allAssesmentGroupFinal();
             
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian Final tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function viewallwithotpaging()
    {
        try {
            $find = $this->AssesmentGroupFinalRepository->viewallwithotpaging();
             
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function byspecialist($id)
    {
        try {
            $find = $this->AssesmentGroupFinalRepository->findAssesmentGroupbyspecialist($id);
             
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    
}