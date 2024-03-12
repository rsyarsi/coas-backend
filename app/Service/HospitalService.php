<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HospitalExport;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\HospitalRepositoryInterface; 

class HospitalService extends Controller
{
    private $hospitalRepository;

    public function __construct(HospitalRepositoryInterface $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([
            "name" => "required",
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'name' => $request->name,
                'active' => $request->active 
            ];
            $execute = $this->hospitalRepository->storeHospital($data,$uuid);
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Rumah Sakit Berhasil dibuat !');
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
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->hospitalRepository->findHospital($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Rumah Sakit tidak ditemukan !',[]);
            }
            $data = [
                'id' => $request->id,                
                'name' => $request->name,
                'active' => $request->active
            ];
            $execute = $this->hospitalRepository->updateHospital($data);
            
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Rumah Sakit Berhasil diupdate !');
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
            $find = $this->hospitalRepository->findHospital($id);
             
            if($find->count() < 1){
                return $this->sendError('Data Rumah Sakit tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Rumah Sakit ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->hospitalRepository->allHospital();
             
            if($find->count() < 1){
                return $this->sendError('Data Rumah Sakit tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Rumah Sakit ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function viewallwithotpaging()
    {
        try {
            $find = $this->hospitalRepository->viewallwithotpaging();
             
            if($find->count() < 1){
                return $this->sendError('Data Rumah Sakit tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Rumah Sakit ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $file = $request->query("file", "csv");

        if ($file == "csv") return Excel::download(new HospitalExport(), "Hospital.csv", \Maatwebsite\Excel\Excel::CSV);
        else if ($file == "xls") return Excel::download(new HospitalExport(), "Hospital.xls", \Maatwebsite\Excel\Excel::XLS);
        else if ($file == "xlsx") return Excel::download(new HospitalExport(), "Hospital.xlsx", \Maatwebsite\Excel\Excel::XLSX);
    }
}
