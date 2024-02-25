<?php

namespace App\Repositories;

use App\Models\emrpedodontie;
use App\Models\emrpedodontie_behaviorrating;
use App\Models\emrpedodontie_treatmen;
use App\Models\emrpedodontie_treatmenplan;
use App\Models\hospital;
use App\Models\Year;
use App\Repositories\Interfaces\EmrPedodontiRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use Carbon\Carbon;

class EmrPedodontiRepository implements EmrPedodontiRepositoryInterface
{
    public function createmedicaldentalhistory($request, $uuid)
    {
        return  DB::table("emrpedodonties")->insert($request);
    } 
    public function findmedicaldentalhistory($data)
    {
        return emrpedodontie::where('id', $data->id)->get();
    }
    public function updatemedicaldentalhistory($data)
    {

        $updates = emrpedodontie::where('id', $data->id)->update([
            'nim' => $data->nim,
            'namamahasiswa' => $data->namamahasiswa,
            'tahunklinik' => $data->tahunklinik,
            'namasupervisor' => $data->namasupervisor,
            'tandatangan' => $data->tandatangan,
            'namapasien' => $data->namapasien,
            'jeniskelamin' => $data->jeniskelamin,
            'usiapasien' => $data->usiapasien,
            'pendidikan' => $data->pendidikan,
            'tgllahirpasien' => $data->tgllahirpasien,
            'namaorangtua' => $data->namaorangtua,
            'telephone' => $data->telephone,
            'pekerjaan' => $data->pekerjaan,
            'dokteranak' => $data->dokteranak,
            'alamatpekerjaan' => $data->alamatpekerjaan,
            'telephonedranak' => $data->telephonedranak,
            'anamnesis' => $data->anamnesis,
            'noregister' => $data->noregister,
            'noepisode' => $data->noepisode,
            'physicalgrowth' => $data->physicalgrowth,
            'heartdesease' => $data->heartdesease,
            'bruiseeasily' => $data->bruiseeasily,
            'anemia' => $data->anemia,
            'hepatitis' => $data->hepatitis,
            'allergic' => $data->allergic,
            'takinganymedicine' => $data->takinganymedicine,
            'beenhospitalized' => $data->beenhospitalized,
            'toothache' => $data->toothache,
            'childtoothache' => $data->childtoothache,
            'firstdental' => $data->firstdental,
            'unfavorabledentalexperience' => $data->unfavorabledentalexperience,
            'ifyes' => $data->ifyes,
            'where' => $data->where,
            'reason' => $data->reason,
            'fingersucking' => $data->fingersucking,
            'diffycultyopeningsjaw' => $data->diffycultyopeningsjaw,
            'howoftenbrushtooth' => $data->howoftenbrushtooth,
            'usefluoridepasta' => $data->usefluoridepasta,
            'fluoridetreatmen' => $data->fluoridetreatmen,
            'bilateralsymmetry' => $data->bilateralsymmetry,
            'asymmetry' => $data->asymmetry,
            'straight' => $data->straight,
            'convex' => $data->convex,
            'concave' => $data->concave,
            'lipsseal' => $data->lipsseal,
            'clicking' => $data->clicking,
            'clickingleft' => $data->clickingleft,
            'clickingright' => $data->clickingright,
            'pain' => $data->pain,
            'painleft' => $data->painleft,
            'painright' => $data->painright,
            'bodypostur' => $data->bodypostur,
            'stageofdentition' => $data->stageofdentition,
            'gingivitis' => $data->gingivitis,
            'stomatitis' => $data->stomatitis,
            'gumboil' => $data->gumboil,
            'dentalanomali' => $data->dentalanomali,
            'prematurloss' => $data->prematurloss,
            'overretainedprimarytooth' => $data->overretainedprimarytooth,
            'dpalatal'  => $data->dpalatal,
            'epalatal'  => $data->epalatal,
            'fpalatal'  => $data->fpalatal,
            'defpalatal'  => $data->defpalatal,
            'dlingual'  => $data->dlingual,
            'elingual'  => $data->elingual,
            'dlingual'  => $data->dlingual,
            'deflingual'  => $data->deflingual,
            'franklscale_definitelynegative_before_treatment'=> $data->franklscale_definitelynegative_before_treatment,
            'franklscale_definitelynegative_during_treatment'=> $data->franklscale_definitelynegative_during_treatment,
            'franklscale_negative_before_treatment'=> $data->franklscale_negative_before_treatment,
            'franklscale_negative_during_treatment'=> $data->franklscale_negative_during_treatment,
            'franklscale_positive_before_treatment'=> $data->franklscale_positive_before_treatment,
            'franklscale_positive_during_treatment'=> $data->franklscale_positive_during_treatment,
            'franklscale_definitelypositive_before_treatment'=> $data->franklscale_definitelypositive_before_treatment,
            'franklscale_definitelypositive_during_treatment'=> $data->franklscale_definitelypositive_during_treatment,
            'buccalpalatal_18'=> $data->buccalpalatal_18,
            'buccalpalatal_17'=> $data->buccalpalatal_17,
            'buccalpalatal_16'=> $data->buccalpalatal_16,
            'buccalpalatal_15_55'=> $data->buccalpalatal_15_55,
            'buccalpalatal_14_54'=> $data->buccalpalatal_14_54,
            'buccalpalatal_13_53'=> $data->buccalpalatal_13_53,
            'buccalpalatal_12_52'=> $data->buccalpalatal_12_52,
            'buccalpalatal_11_51'=> $data->buccalpalatal_11_51,
            'buccalpalatal_21_61'=> $data->buccalpalatal_21_61,
            'buccalpalatal_22_62'=> $data->buccalpalatal_22_62,
            'buccalpalatal_23_63'=> $data->buccalpalatal_23_63,
            'buccalpalatal_24_64'=> $data->buccalpalatal_24_64,
            'buccalpalatal_25_65'=> $data->buccalpalatal_25_65,
            'buccalpalatal_26'=> $data->buccalpalatal_26,
            'buccalpalatal_27'=> $data->buccalpalatal_27,
            'buccalpalatal_28'=> $data->buccalpalatal_28,
            'buccalpalatal_48'=> $data->buccalpalatal_48,
            'buccalpalatal_47'=> $data->buccalpalatal_47,
            'buccalpalatal_46'=> $data->buccalpalatal_46,
            'buccalpalatal_45_85'=> $data->buccalpalatal_45_85,
            'buccalpalatal_44_84'=> $data->buccalpalatal_44_84,
            'buccalpalatal_43_83'=> $data->buccalpalatal_43_83,
            'buccalpalatal_42_82'=> $data->buccalpalatal_42_82,
            'buccalpalatal_41_81'=> $data->buccalpalatal_41_81,
            'buccalpalatal_31_71'=> $data->buccalpalatal_31_71,
            'buccalpalatal_32_72'=> $data->buccalpalatal_32_72,
            'buccalpalatal_33_73'=> $data->buccalpalatal_33_73,
            'buccalpalatal_34_74'=> $data->buccalpalatal_34_74,
            'buccalpalatal_35_75'=> $data->buccalpalatal_35_75,
            'buccalpalatal_36'=> $data->buccalpalatal_36,
            'buccalpalatal_37'=> $data->buccalpalatal_37,
            'buccalpalatal_38'=> $data->buccalpalatal_38,
        
        ]);
        return $updates;;
    }

    //behavior rating
    public function createbehaviorrating($data)
    {
        return  DB::table("emrpedodontie_behaviorratings")->insert($data);
    }
    public function updatebehaviorrating($data)
    {

        $updates = emrpedodontie_behaviorrating::where('id', $data->id)->update([
            'emrid' => $data->emrid,
            'frankscale' => $data->frankscale,
            'beforetreatment' => $data->beforetreatment,
            'duringtreatment' => $data->duringtreatment,
        ]);
        return $updates;;
    }
    public function deletebehaviorrating($data)
    {
        return  DB::table("emrpedodontie_behaviorratings")->where('id',$data->id)->delete();
    }
    public function findbehaviorratingbyId($data)
    {
        return emrpedodontie_behaviorrating::where('id', $data->id)->get();
    }
    public function viewemrbyRegOperator($data)
    {
        return emrpedodontie::where('nim', $data->nim)->where('noregister', $data->noregister)->get(); 
    }
    public function findbehaviorratingAll($data)
    {
        return emrpedodontie_behaviorrating::where('emrid', $data->emrid)->get();
    }

    // treatment
    public function createtreatment($data)
    {
        return emrpedodontie_treatmen::create($data);
    }
    public function updatetreatment($data)
    {

        $updates = emrpedodontie_treatmen::where('id', $data->id)->update([
            'emrid' => $data->emrid,
            'datetreatment' => $data->datetreatment,
            'itemtreatment' => $data->itemtreatment,
            'supervisorvalidate' => $data->supervisorvalidate,            
            'userentry' => $data->userentry,
            'userentryname' => $data->userentryname,
        ]);
        return $updates;
    }
    public function validatesupervisor($data)
    { 
        $updates = emrpedodontie_treatmen::where('id', $data->id)->update([
            'supervisorvalidate' => Carbon::now(),
            'supervisousername' => $data->supervisousername, 
            'supervisorname' => $data->supervisorname, 
        ]);
        return $updates;
    }
    public function deletetreatment($data)
    {
        return  emrpedodontie_treatmen::where('id',$data->id)->delete();
    }
    public function findtreatmentbyId($data)
    {
        return emrpedodontie_treatmen::where('id', $data->id)->get();
    }
    public function findtreatmentAll($data)
    {
        return emrpedodontie_treatmen::where('emrid', $data->emrid)->orderBy('id', 'DESC')->latest()->paginate(10);
    }

    // treatment
    public function createtreatmentplan($data)
    {
        return emrpedodontie_treatmenplan::create($data);
    }
    public function updatetreatmentplan($data)
    {

        $updates = emrpedodontie_treatmenplan::where('id', $data->id)->update([
            'emrid' => $data->emrid,
            'datetreatmentplanentry' => $data->datetreatmentplanentry,
            'oralfinding' => $data->oralfinding,
            'diagnosis' => $data->diagnosis,
            'treatmentplanning' => $data->treatmentplanning,            
            'userentry' => $data->userentry,
            'userentryname' => $data->userentryname,
        ]);
        return $updates;
    }
    public function deletetreatmentplan($data)
    {
        return  emrpedodontie_treatmenplan::where('id',$data->id)->delete();
    }
    public function findtreatmentplanbyId($data)
    {
        return emrpedodontie_treatmenplan::where('id', $data->id)->get();
    }
    public function findtreatmentplanAll($data)
    {
        return emrpedodontie_treatmenplan::where('emrid', $data->emrid)->orderBy('id', 'DESC')->latest()->paginate(10);
    }
    public function uploadfoto($data,$awsurl)
    { 
        $updates = emrpedodontie::where('id', $data->id)->update([ 
            'odontogramfoto' => $awsurl 
        ]);
        return $updates;
    }
}