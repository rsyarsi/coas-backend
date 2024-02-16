<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\EmrPedodontiRepositoryInterface;
use App\Repositories\Interfaces\HospitalRepositoryInterface;

class EmrPedodontiService extends Controller
{
    private $emrpedodontiRepository;

    public function __construct(EmrPedodontiRepositoryInterface $emrpedodontiRepository)
    {
        $this->emrpedodontiRepository = $emrpedodontiRepository;
    }
    public function createmedicaldentalhistory(Request $request)
    {
        // validate 
        $request->validate([
            "noregister" => "required",
            "noepisode" => "required",
            "physicalgrowth" => "required",
            "heartdesease" => "required",
            'bruiseeasily' => "required",
            'anemia' => "required",
            'hepatitis' => "required",
            'allergic' => "required",
            'takinganymedicine' => "required",
            'beenhospitalized' => "required",
            'toothache' => "required",
            'childtoothache' => "required",
            'firstdental' => "required",
            'unfavorabledentalexperience' => "required",
            'ifyes' => "required",
            'where' => "required",
            'reason' => "required",
            'fingersucking' => "required",
            'diffycultyopeningsjaw' => "required",
            'howoftenbrushtooth' => "required",
            'usefluoridepasta' => "required",
            'fluoridetreatmen' => "required",
            'bilateralsymmetry' => "required",
            'asymmetry' => "required",
            'straight' => "required",
            'convex' => "required",
            'concave' => "required",
            'lipsseal' => "required",
            'clicking' => "required",
            'clickingleft' => "required",
            'clickingright' => "required",
            'pain' => "required",
            'painleft' => "required",
            'painright' => "required",
            'bodypostur' => "required",
            'stageofdentition' => "required",
            'gingivitis' => "required",
            'stomatitis' => "required",
            'gumboil' => "required",
            'dentalanomali' => "required",
            'prematurloss' => "required",
            'overretainedprimarytooth' => "required"
        ]);

        try {

            // Db Transaction
            DB::beginTransaction();
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                'noregister' => $request->noregister,
                'noepisode' => $request->noepisode,
                'physicalgrowth' => $request->physicalgrowth,
                'heartdesease' => $request->heartdesease,
                'bruiseeasily' => $request->bruiseeasily,
                'anemia' => $request->anemia,
                'hepatitis' => $request->hepatitis,
                'allergic' => $request->allergic,
                'takinganymedicine' => $request->takinganymedicine,
                'beenhospitalized' => $request->beenhospitalized,
                'toothache' => $request->toothache,
                'childtoothache' => $request->childtoothache,
                'firstdental' => $request->firstdental,
                'unfavorabledentalexperience' => $request->unfavorabledentalexperience,
                'ifyes' => $request->ifyes,
                'where' => $request->where,
                'reason' => $request->reason,
                'fingersucking' => $request->fingersucking,
                'diffycultyopeningsjaw' => $request->diffycultyopeningsjaw,
                'howoftenbrushtooth' => $request->howoftenbrushtooth,
                'usefluoridepasta' => $request->usefluoridepasta,
                'fluoridetreatmen' => $request->fluoridetreatmen,
                'bilateralsymmetry' => $request->bilateralsymmetry,
                'asymmetry' => $request->asymmetry,
                'straight' => $request->straight,
                'convex' => $request->convex,
                'concave' => $request->concave,
                'lipsseal' => $request->lipsseal,
                'clicking' => $request->clicking,
                'clickingleft' => $request->clickingleft,
                'clickingright' => $request->clickingright,
                'pain' => $request->pain,
                'painleft' => $request->painleft,
                'painright' => $request->painright,
                'bodypostur' => $request->bodypostur,
                'stageofdentition' => $request->stageofdentition,
                'gingivitis' => $request->gingivitis,
                'stomatitis' => $request->stomatitis,
                'gumboil' => $request->gumboil,
                'dentalanomali' => $request->dentalanomali,
                'prematurloss' => $request->prematurloss,
                'overretainedprimarytooth'  => $request->overretainedprimarytooth
            ];
            $cekdata = $this->emrpedodontiRepository->findmedicaldentalhistory($request);

            if ($cekdata->count() < 1) {
                $execute = $this->emrpedodontiRepository->createmedicaldentalhistory($data, $uuid);
                $message = 'Assesment Pedodonti Berhasil Dibuat !';
            } else {
                $execute = $this->emrpedodontiRepository->updatemedicaldentalhistory($request);
                $message = 'Assesment Pedodonti Berhasil Diperbarui !';
            }

            DB::commit();
            if ($execute) {
                return $this->sendResponse($data, $message);
            }

            // if ($cekdata->count() < 1) {
            //     $execute = $this->emrpedodontiRepository->createmedicaldentalhistory($data, $uuid);
            // } else {
            //     $execute = $this->emrpedodontiRepository->updatemedicaldentalhistory($request);
            // }

            // DB::commit();
            // if ($execute) {
            //     return $this->sendResponse($data, 'Assesment Pedodonti Berhasil Dibuat !');
            // } else {
            //     $execute = $this->emrpedodontiRepository->updatemedicaldentalhistory($request);
            //     $message = 'Assesment Pedodonti Berhasil Diperbarui !';
            // }
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    //behavior rating
    public function behaviorratingcreate(Request $request)
    {
      
            // validate 
        $request->validate([ 
            "emrid" => "required", 
            "frankscale" => "required", 
            "beforetreatment" => "required",   
            "duringtreatment" => "required",
            "userentryname" => "required" 
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
            // $findmedicalhistory = $this->emrpedodontiRepository->findmedicaldentalhistory($request->emrid);
            // dd($findmedicalhistory);
            // if($findmedicalhistory->count() < 1){
            //     return $this->sendError('Medical History tidak ditemukan !', []);
            // }
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'emrid' => $request->emrid,
                'frankscale' => $request->frankscale, 
                'beforetreatment' => $request->beforetreatment,  
                'duringtreatment' => $request->duringtreatment,
                'userentryname' => $request->userentryname 
            ];
       
            $execute = $this->emrpedodontiRepository->createbehaviorrating($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Behavior rating berhasil ditambahkan !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function behaviorratingupdate(Request $request)
    {
        $request->validate([ 
            "id" => "required", 
            "emrid" => "required", 
            "frankscale" => "required", 
            "beforetreatment" => "required",   
            "duringtreatment" => "required", 
            "userentryname" => "required" 
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
            // $findmedicalhistory = $this->emrpedodontiRepository->findmedicaldentalhistory($request->emrid);
            // dd($findmedicalhistory);
            // if($findmedicalhistory->count() < 1){
            //     return $this->sendError('Medical History tidak ditemukan !', []);
            // } 
            $data = [
                'id' => $request->id,                
                'emrid' => $request->emrid,
                'frankscale' => $request->frankscale, 
                'beforetreatment' => $request->beforetreatment,  
                'duringtreatment' => $request->duringtreatment, 
                'userentryname' => $request->duringtreatment 
            ];
       
            $execute = $this->emrpedodontiRepository->updatebehaviorrating($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Behavior rating berhasil dirubah !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function behaviorratingdelete(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 

            $findmedicalhistory = $this->emrpedodontiRepository->findbehaviorratingbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Behavior Rating tidak ditemukan !', []);
            } 

            $data = [
                'id' => $request->id,                 
            ];
       
            $execute = $this->emrpedodontiRepository->deletebehaviorrating($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Behavior rating berhasil dihapus !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function behaviorratingviewbyid(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrpedodontiRepository->findbehaviorratingbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Behavior Rating tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory->first(), 'Behavior rating berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function behaviorratingviewall(Request $request)
    {
        $request->validate([ 
            "emrid" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrpedodontiRepository->findbehaviorratingAll($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Behavior Rating tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory, 'Behavior rating berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    // treatment
    public function treatmentcreate(Request $request)
    {
      
            // validate 
        $request->validate([ 
            "emrid" => "required", 
            "datetreatment" => "required",  
            "itemtreatment" => "required",    
            "userentryname" => "required" 
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
            // $findmedicalhistory = $this->emrpedodontiRepository->findmedicaldentalhistory($request->emrid);
            // dd($findmedicalhistory);
            // if($findmedicalhistory->count() < 1){
            //     return $this->sendError('Medical History tidak ditemukan !', []);
            // }
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'emrid' => $request->emrid,
                'datetreatment' => $request->datetreatment, 
                'itemtreatment' => $request->itemtreatment,  
                'supervisorvalidate' => $request->supervisorvalidate,
                'userentryname' => $request->userentryname 
            ];
       
            $execute = $this->emrpedodontiRepository->createtreatment($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment berhasil ditambahkan !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function treatmentupdate(Request $request)
    {
        $request->validate([ 
            "id" => "required", 
            "emrid" => "required", 
            "datetreatment" => "required",  
            "itemtreatment" => "required",    
            "userentryname" => "required" 
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
            // $findmedicalhistory = $this->emrpedodontiRepository->findmedicaldentalhistory($request->emrid);
            // dd($findmedicalhistory);
            // if($findmedicalhistory->count() < 1){
            //     return $this->sendError('Medical History tidak ditemukan !', []);
            // } 
            $data = [
                'id' => $request->id,                
                'emrid' => $request->emrid,
                'datetreatment' => $request->datetreatment, 
                'itemtreatment' => $request->itemtreatment,  
                'supervisorvalidate' => $request->supervisorvalidate,
                'userentryname' => $request->userentryname 
            ];
       
            $execute = $this->emrpedodontiRepository->updatetreatment($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment Plan berhasil dirubah !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function treatmentdelete(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 

            $findmedicalhistory = $this->emrpedodontiRepository->findtreatmentbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment tidak ditemukan !', []);
            } 

            $data = [
                'id' => $request->id,                 
            ];
       
            $execute = $this->emrpedodontiRepository->deletetreatment($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment berhasil dihapus !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function treatmentviewbyid(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrpedodontiRepository->findtreatmentbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory->first(), 'Treatment berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function treatmentviewall(Request $request)
    {
        $request->validate([ 
            "emrid" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrpedodontiRepository->findbehaviorratingAll($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Behavior Rating tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory, 'Behavior rating berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function validatesupervisor(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "supervisorname" => "required" 
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
            // $findmedicalhistory = $this->emrpedodontiRepository->findmedicaldentalhistory($request->emrid);
            // dd($findmedicalhistory);
            // if($findmedicalhistory->count() < 1){
            //     return $this->sendError('Medical History tidak ditemukan !', []);
            // } 
            $data = [
                'id' => $request->id,                 
                'supervisorname' => $request->supervisorname 
            ];
       
            $execute = $this->emrpedodontiRepository->validatesupervisor($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment Plan berhasil dirubah !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
}