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
            'buccal_18' => $data->buccal_18,
            'buccal_17' => $data->buccal_17,
            'buccal_16' => $data->buccal_16,
            'buccal_15' => $data->buccal_15,
            'buccal_14' => $data->buccal_14,
            'buccal_13' => $data->buccal_13,
            'buccal_12' => $data->buccal_12,
            'buccal_11' => $data->buccal_11,
            'buccal_21' => $data->buccal_21,
            'buccal_22' => $data->buccal_22,
            'buccal_23' => $data->buccal_23,
            'buccal_24' => $data->buccal_24,
            'buccal_25' => $data->buccal_25,
            'buccal_26' => $data->buccal_26,
            'buccal_27' => $data->buccal_27,
            'buccal_28' => $data->buccal_28,
            'palatal_55' => $data->palatal_55,
            'palatal_54' => $data->palatal_54,
            'palatal_53' => $data->palatal_53,
            'palatal_52' => $data->palatal_52,
            'palatal_51' => $data->palatal_51,
            'palatal_61' => $data->palatal_61,
            'palatal_62' => $data->palatal_62,
            'palatal_63' => $data->palatal_63,
            'palatal_64' => $data->palatal_64,
            'palatal_65' => $data->palatal_65,
            'buccal_85' => $data->buccal_85,
            'buccal_84' => $data->buccal_84,
            'buccal_83' => $data->buccal_83,
            'buccal_82' => $data->buccal_82,
            'buccal_81' => $data->buccal_81,
            'buccal_71' => $data->buccal_71,
            'buccal_72' => $data->buccal_72,
            'buccal_73' => $data->buccal_73,
            'buccal_74' => $data->buccal_74,
            'buccal_75' => $data->buccal_75,
            'palatal_48' => $data->palatal_48,
            'palatal_47' => $data->palatal_47,
            'palatal_46' => $data->palatal_46,
            'palatal_45' => $data->palatal_45,
            'palatal_44' => $data->palatal_44,
            'palatal_43' => $data->palatal_43,
            'palatal_42' => $data->palatal_42,
            'palatal_41' => $data->palatal_41,
            'palatal_31' => $data->palatal_31,
            'palatal_32' => $data->palatal_32,
            'palatal_33' => $data->palatal_33,
            'palatal_34' => $data->palatal_34,
            'palatal_35' => $data->palatal_35,
            'palatal_36' => $data->palatal_36,
            'palatal_37' => $data->palatal_37,
            'palatal_38' => $data->palatal_38,
            
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