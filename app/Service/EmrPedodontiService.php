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
        ]);

        try {

            // Db Transaction
            DB::beginTransaction();
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                'nim' => $request->nim,
                'namamahasiswa' => $request->namamahasiswa,
                'tahunklinik' => $request->tahunklinik,
                'namasupervisor' => $request->namasupervisor,
                'tandatangan' => $request->tandatangan,
                'namapasien' => $request->namapasien,
                'jeniskelamin' => $request->jeniskelamin,
                'usiapasien' => $request->usiapasien,
                'pendidikan' => $request->pendidikan,
                'tgllahirpasien' => $request->tgllahirpasien,
                'namaorangtua' => $request->namaorangtua,
                'telephone' => $request->telephone,
                'pekerjaan' => $request->pekerjaan,
                'dokteranak' => $request->dokteranak,
                'alamatpekerjaan' => $request->alamatpekerjaan,
                'telephonedranak' => $request->telephonedranak,
                'anamnesis' => $request->anamnesis,
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
                'overretainedprimarytooth'  => $request->overretainedprimarytooth,
                'dpalatal'  => $request->dpalatal,
                'epalatal'  => $request->epalatal,
                'fpalatal'  => $request->fpalatal,
                'defpalatal'  => $request->defpalatal,
                'dlingual'  => $request->dlingual,
                'elingual'  => $request->elingual,
                'dlingual'  => $request->dlingual,
                'deflingual'  => $request->deflingual,
                'franklscale_definitelynegative_before_treatment'=> $request->franklscale_definitelynegative_before_treatment,
                'franklscale_definitelynegative_during_treatment'=> $request->franklscale_definitelynegative_during_treatment,
                'franklscale_negative_before_treatment'=> $request->franklscale_negative_before_treatment,
                'franklscale_negative_during_treatment'=> $request->franklscale_negative_during_treatment,
                'franklscale_positive_before_treatment'=> $request->franklscale_positive_before_treatment,
                'franklscale_positive_during_treatment'=> $request->franklscale_positive_during_treatment,
                'franklscale_definitelypositive_before_treatment'=> $request->franklscale_definitelypositive_before_treatment,
                'franklscale_definitelypositive_during_treatment'=> $request->franklscale_definitelypositive_during_treatment,
                'buccal_18' => $request->buccal_18,
                'buccal_17' => $request->buccal_17,
                'buccal_16' => $request->buccal_16,
                'buccal_15' => $request->buccal_15,
                'buccal_14' => $request->buccal_14,
                'buccal_13' => $request->buccal_13,
                'buccal_12' => $request->buccal_12,
                'buccal_11' => $request->buccal_11,
                'buccal_21' => $request->buccal_21,
                'buccal_22' => $request->buccal_22,
                'buccal_23' => $request->buccal_23,
                'buccal_24' => $request->buccal_24,
                'buccal_25' => $request->buccal_25,
                'buccal_26' => $request->buccal_26,
                'buccal_27' => $request->buccal_27,
                'buccal_28' => $request->buccal_28,
                'palatal_55' => $request->palatal_55,
                'palatal_54' => $request->palatal_54,
                'palatal_53' => $request->palatal_53,
                'palatal_52' => $request->palatal_52,
                'palatal_51' => $request->palatal_51,
                'palatal_61' => $request->palatal_61,
                'palatal_62' => $request->palatal_62,
                'palatal_63' => $request->palatal_63,
                'palatal_64' => $request->palatal_64,
                'palatal_65' => $request->palatal_65,
                'buccal_85' => $request->buccal_85,
                'buccal_84' => $request->buccal_84,
                'buccal_83' => $request->buccal_83,
                'buccal_82' => $request->buccal_82,
                'buccal_81' => $request->buccal_81,
                'buccal_71' => $request->buccal_71,
                'buccal_72' => $request->buccal_72,
                'buccal_73' => $request->buccal_73,
                'buccal_74' => $request->buccal_74,
                'buccal_75' => $request->buccal_75,
                'palatal_48' => $request->palatal_48,
                'palatal_47' => $request->palatal_47,
                'palatal_46' => $request->palatal_46,
                'palatal_45' => $request->palatal_45,
                'palatal_44' => $request->palatal_44,
                'palatal_43' => $request->palatal_43,
                'palatal_42' => $request->palatal_42,
                'palatal_41' => $request->palatal_41,
                'palatal_31' => $request->palatal_31,
                'palatal_32' => $request->palatal_32,
                'palatal_33' => $request->palatal_33,
                'palatal_34' => $request->palatal_34,
                'palatal_35' => $request->palatal_35,
                'palatal_36' => $request->palatal_36,
                'palatal_37' => $request->palatal_37,
                'palatal_38' => $request->palatal_38
                
                
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
            "select_file" => "required|max:10000" 
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
       
           $this->emrpedodontiRepository->uploadfoto($request,$upload);
            DB::commit();

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
                'diagnosis' => $request->diagnosis,
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
                'diagnosis' => $request->diagnosis,  
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
    public function viewemrbyRegOperator(Request $request)
    {
        $request->validate([ 
            "noregister" => "required",            
            "nim" => "required"
   
        ]);
      
        try {    
            DB::beginTransaction();

            $cekdata = $this->emrpedodontiRepository->viewemrbyRegOperator($request);

            if($cekdata->count() < 1){
                $uuid = Uuid::uuid4();
                $data = [
                    'id' => $uuid,
                    'nim' => $request->nim,
                    "noregister" => $request->noregister,
                    "noepisode" => null,
                ];


                $this->emrpedodontiRepository->createmedicaldentalhistory($data, $uuid);
                $message = 'Assesment Pedodonsi Berhasil Dibuat !';

                 DB::commit();
 
                return $this->sendResponse($data, $message);
            }else{
                $uuiddata = $cekdata->first(); 
                return $this->sendResponse($uuiddata, 'DataEMR ditemukan !');
            }
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
}