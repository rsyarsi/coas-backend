<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AssesmentDetailRepositoryInterface;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;

class AssesmentDetailService extends Controller
{
    private $SpecialistRepository;
    private $AssesmentGroupRepository;    
    private $AssesmentDetailRepository;


    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        AssesmentGroupRepositoryInterface $AssesmentGroupRepository,        
        AssesmentDetailRepositoryInterface $AssesmentDetailRepository
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->AssesmentGroupRepository = $AssesmentGroupRepository;        
        $this->AssesmentDetailRepository = $AssesmentDetailRepository;

    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "assesmentgroupID" => "required", 
            "assementdescription" => "required",             
            "assementbobotvalue" => "required",  
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findassesmentgroup = $this->AssesmentGroupRepository->findAssesmentGroup($request->assesmentgroupID);
            if($findassesmentgroup->count() < 1){
                return $this->sendError('Grup Penilaian tidak ditemukan !', []);
            }
            $execute = $this->AssesmentDetailRepository->storeAssesmentDetail($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($execute, 'Penilaian Detail Berhasil dibuat !');
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
            "assesmentgroupID" => "required", 
            "assementdescription" => "required",             
            "assementbobotvalue" => "required",  
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->AssesmentDetailRepository->findAssesmentDetail($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Penilaian Detail tidak ditemukan !',[]);
            }

            $findspecialist = $this->AssesmentGroupRepository->findAssesmentGroup($request->assesmentgroupID);
            if($findspecialist->count() < 1){
                return $this->sendError('Grup Penilaian tidak di temukan !', []);
            }

            $execute = $this->AssesmentDetailRepository->updateAssesmentDetail($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($execute, 'Penilaian Detail Berhasil diupdate !');
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
            
            $find = $this->AssesmentDetailRepository->findAssesmentDetail($id); 
            if($find->count() < 1){
                return $this->sendError('Data Penilaian Detail tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Penilaian Detail ditemukan !');

        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function groupid($id)
    {
        try {
            
            $find = $this->AssesmentDetailRepository->findAssesmentbyGroup($id); 
            
            if($find->count() < 1){
                return $this->sendError('Data Penilaian Detail by Group tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Penilaian Detail by Group ditemukan !');

        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->AssesmentDetailRepository->allAssesmentDetail();
             
            if($find->count() < 1){
                return $this->sendError('Data Penilaian Detail tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Penilaian Detail ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}