<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use App\Repositories\Interfaces\AssesmentDetailRepositoryInterface;

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
            "assesmentgroupid" => "required", 
            "assesmentdescription" => "required",             
            "assesmentbobotvalue" => "required",   
            "assesmentvaluestart" => "required",   
            "assesmentvalueend" => "required",   
            "assesmentnumbers" => "required",   
            "assesmentskalavalue" => "required",   
            "assesmentskalavaluestart" => "required",   
            "assesmentskalavalueend" => "required", 
            "assesmentkonditevalue" => "required",  
            "assesmentkonditevaluestart" => "required",   
            "assesmentkonditevalueend" => "required",   
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findassesmentgroup = $this->AssesmentGroupRepository->findAssesmentGroup($request->assesmentgroupid);
            if($findassesmentgroup->count() < 1){
                return $this->sendError('Grup Penilaian tidak ditemukan !', []);
            }

            // validate kode sub
          
            if($request->kodesub > 0 and $request->index_sub < 1){
                return $this->sendError('Kode Sub sudah terisi, Kode Index sub harus lebih besar dari 0 !', []);
            }
 

            if($request->kodesub > 0 ){
               $validatesub = $this->AssesmentDetailRepository->validateSubAssesment($request);
                if($validatesub->count() > 0){
                    return $this->sendError('Sub Kode Sudah ada, silahkan gunakan kode sub lain !', []);
                }else{
                    if($validatesub->count() < 1){
                        $kode_sub_name = $request->assesmentdescription;
                    }else{
                        $kode_sub_name = $validatesub->first()->kode_sub_name;
                    }
                }
            }else{
                $validatesub = $this->AssesmentDetailRepository->validateSubAssesment($request);
              
                if($validatesub->count() < 1){
                    $kode_sub_name = $request->assesmentdescription;
                }else{
                    $kode_sub_name = $validatesub->first()->kode_sub_name;
                }
            }
      
            $uuid = Uuid::uuid4(); 
           
            
           
            $data = [
                'id' => $uuid,                
                'assesmentgroupid' => $request->assesmentgroupid,
                'assesmentnumbers' => $request->assesmentnumbers,
                'assesmentdescription' => $request->assesmentdescription,
                'kode_sub_name' => $kode_sub_name,
                'assesmentbobotvalue' => $request->assesmentbobotvalue, 
                'assesmentskalavalue' => $request->assesmentskalavalue,  
                'assesmentvaluestart' => $request->assesmentvaluestart,  
                'assesmentvalueend' => $request->assesmentvalueend,  
                'assesmentskalavaluestart' => $request->assesmentskalavaluestart, 
                'assesmentskalavalueend' => $request->assesmentskalavalueend, 
                'assesmentkonditevalue' => $request->assesmentkonditevalue,  
                'kodesub' => $request->kodesub,   
                'index_sub' => $request->index_sub,  
                'assesmentkonditevaluestart' => $request->assesmentkonditevaluestart, 
                'assesmentkonditevalueend' => $request->assesmentkonditevalueend, 
                'active' => $request->active 
            ];
            $execute = $this->AssesmentDetailRepository->storeAssesmentDetail($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Penilaian Detail Berhasil dibuat !');
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
            "assesmentgroupid" => "required", 
            "assesmentdescription" => "required",             
            "assesmentnumbers" => "required",   
            "assesmentbobotvalue" => "required",   
            "assesmentvaluestart" => "required",   
            "assesmentvalueend" => "required",   
            "assesmentskalavalue" => "required",   
            "assesmentskalavaluestart" => "required",   
            "assesmentskalavalueend" => "required", 
            "assesmentkonditevalue" => "required", 
            "assesmentkonditevaluestart" => "required",   
            "assesmentkonditevalueend" => "required", 
            "kodesub" => "required", 
            "index_sub" => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->AssesmentDetailRepository->findAssesmentDetail($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Penilaian Detail tidak ditemukan !',[]);
            }
            
            $findspecialist = $this->AssesmentGroupRepository->findAssesmentGroup($request->assesmentgroupid);
            if($findspecialist->count() < 1){
                return $this->sendError('Grup Penilaian tidak di temukan !', []);
            }  
           
            if($request->kodesub > 0 and $request->index_sub < 1){
                return $this->sendError('Kode Sub sudah terisi, Kode Index sub harus lebih besar dari 0 !', []);
            }

            if($request->kodesub > 0 ){
               $validatesub = $this->AssesmentDetailRepository->validateSubAssesment($request);
                if($validatesub->count() > 0){
                    return $this->sendError('Sub Kode Sudah ada, silahkan gunakan kode sub lain !', []);
                }else{
                    if($validatesub->count() < 1){
                        $kode_sub_name = $request->assesmentdescription;
                    }else{
                        $kode_sub_name = $validatesub->first()->kode_sub_name;
                    }
                }
            }else{
                $validatesub = $this->AssesmentDetailRepository->validateSubAssesment($request);
                if($validatesub->count() < 1){
                    $kode_sub_name = $request->assesmentdescription;
                }else{
                    $kode_sub_name = $validatesub->first()->kode_sub_name;
                }
            }

            
            $data = [
                'id' => $request->id,                
                'assesmentgroupid' => $request->assesmentgroupid,
                'assesmentnumbers' => $request->assesmentnumbers,
                'assesmentdescription' => $request->assesmentdescription, 
                'kode_sub_name' => $kode_sub_name,
                'assesmentbobotvalue' => $request->assesmentbobotvalue, 
                'assesmentvaluestart' => $request->assesmentvaluestart, 
                'assesmentvalueend' => $request->assesmentvalueend, 
                'assesmentskalavalue' => $request->assesmentskalavalue,  
                'assesmentskalavaluestart' => $request->assesmentskalavaluestart, 
                'assesmentskalavalueend' => $request->assesmentskalavalueend, 
                'assesmentkonditevalue' => $request->assesmentkonditevalue, 
                'assesmentkonditevaluestart' => $request->assesmentkonditevaluestart, 
                'assesmentkonditevalueend' => $request->assesmentkonditevalueend,
                'kodesub' => $request->kodesub,   
                'index_sub' => $request->index_sub,   
                'active' => $request->active 
            ];
            $execute = $this->AssesmentDetailRepository->updateAssesmentDetail($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Penilaian Detail Berhasil diupdate !');
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
    public function viewallwithotpaging()
    {
        try {
            $find = $this->AssesmentDetailRepository->viewallwithotpaging();
             
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