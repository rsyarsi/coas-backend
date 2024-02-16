<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Aws\S3\S3Client;
use Ramsey\Uuid\Uuid;
use App\Traits\AwsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use App\Repositories\Interfaces\EmrPedodontiRepositoryInterface;

class EmrPedodontiService extends Controller
{
    use AwsTrait;
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
            "userentryname" => "required",
            "userentry" => "required"
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
                'userentry' => $request->userentry, 
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
            "userentryname" => "required",
            "userentry" => "required"
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
                'userentry' => $request->userentry, 
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
            $findmedicalhistory = $this->emrpedodontiRepository->findtreatmentAll($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory, 'Treatment berhasil ditemukan !');
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
            "supervisousername" => "required",
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
                'supervisousername' => $request->supervisousername,
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

    public function uploadfoto(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000",
            "notes" => "required" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/pedodonti/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
        //    $this->emrpedodontiRepository->uploadfoto($request);
        //     DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    // treatmentplan
    public function treatmentplancreate(Request $request)
    {
      
            // validate 
        $request->validate([ 
            "emrid" => "required", 
            "datetreatmentplanentry" => "required",  
            "oralfinding" => "required",    
            "diagnosis" => "required",    
            "treatmentplanning" => "required",    
            "userentry" => "required",     
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
                'datetreatmentplanentry' => $request->datetreatmentplanentry, 
                'oralfinding' => $request->oralfinding,  
                'diagnosis' => $request->supervisorvalidate,
                'treatmentplanning' => $request->treatmentplanning,
                'userentry' => $request->userentry, 
                'userentryname' => $request->userentryname 
            ];
       
            $execute = $this->emrpedodontiRepository->createtreatmentplan($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment Plan berhasil ditambahkan !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function treatmentplanupdate(Request $request)
    {
        $request->validate([ 
            "emrid" => "required", 
            "datetreatmentplanentry" => "required",  
            "oralfinding" => "required",    
            "diagnosis" => "required",    
            "treatmentplanning" => "required",    
            "userentry" => "required",     
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
       
            $execute = $this->emrpedodontiRepository->updatetreatmentplan($request);
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

    public function treatmentplandelete(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 

            $findmedicalhistory = $this->emrpedodontiRepository->findtreatmentplanbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment tidak ditemukan !', []);
            } 

            $data = [
                'id' => $request->id,                 
            ];
       
            $execute = $this->emrpedodontiRepository->deletetreatmentplan($request);
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

    public function treatmentplanviewbyid(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrpedodontiRepository->findtreatmentplanbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment Plan tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory->first(), 'Treatment berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function treatmentplanviewall(Request $request)
    {
        $request->validate([ 
            "emrid" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrpedodontiRepository->findtreatmentplanAll($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment Plan tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory, 'Treatment Plan berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}