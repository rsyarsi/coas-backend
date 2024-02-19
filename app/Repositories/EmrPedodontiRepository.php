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
            'franklscale_definitelynegative_before_treatment'=> $data->franklscale_definitelynegative_before_treatment,
            'franklscale_definitelynegative_during_treatment'=> $data->franklscale_definitelynegative_during_treatment,
            'franklscale_negative_before_treatment'=> $data->franklscale_negative_before_treatment,
            'franklscale_negative_during_treatment'=> $data->franklscale_negative_during_treatment,
            'franklscale_positive_before_treatment'=> $data->franklscale_positive_before_treatment,
            'franklscale_positive_during_treatment'=> $data->franklscale_positive_during_treatment,
            'franklscale_definitelypositive_before_treatment'=> $data->franklscale_definitelypositive_before_treatment,
            'franklscale_definitelypositive_during_treatment'=> $data->franklscale_definitelypositive_during_treatment,
            'BuccalPalatal_18'=> $data->BuccalPalatal_18,
            'BuccalPalatal_17'=> $data->BuccalPalatal_17,
            'BuccalPalatal_16'=> $data->BuccalPalatal_16,
            'BuccalPalatal_15_55'=> $data->BuccalPalatal_15_55,
            'BuccalPalatal_14_54'=> $data->BuccalPalatal_14_54,
            'BuccalPalatal_13_53'=> $data->BuccalPalatal_13_53,
            'BuccalPalatal_12_52'=> $data->BuccalPalatal_12_52,
            'BuccalPalatal_11_51'=> $data->BuccalPalatal_11_51,
            'BuccalPalatal_21_61'=> $data->BuccalPalatal_21_61,
            'BuccalPalatal_22_62'=> $data->BuccalPalatal_22_62,
            'BuccalPalatal_23_63'=> $data->BuccalPalatal_23_63,
            'BuccalPalatal_24_64'=> $data->BuccalPalatal_24_64,
            'BuccalPalatal_25_65'=> $data->BuccalPalatal_25_65,
            'BuccalPalatal_26'=> $data->BuccalPalatal_26,
            'BuccalPalatal_27'=> $data->BuccalPalatal_27,
            'BuccalPalatal_28'=> $data->BuccalPalatal_28,
            'BuccalPalatal_48'=> $data->BuccalPalatal_48,
            'BuccalPalatal_47'=> $data->BuccalPalatal_47,
            'BuccalPalatal_46'=> $data->BuccalPalatal_46,
            'BuccalPalatal_45_85'=> $data->BuccalPalatal_45_85,
            'BuccalPalatal_44_84'=> $data->BuccalPalatal_44_84,
            'BuccalPalatal_43_83'=> $data->BuccalPalatal_43_83,
            'BuccalPalatal_42_82'=> $data->BuccalPalatal_42_82,
            'BuccalPalatal_41_81'=> $data->BuccalPalatal_41_81,
            'BuccalPalatal_31_71'=> $data->BuccalPalatal_31_71,
            'BuccalPalatal_32_72'=> $data->BuccalPalatal_32_72,
            'BuccalPalatal_33_73'=> $data->BuccalPalatal_33_73,
            'BuccalPalatal_34_74'=> $data->BuccalPalatal_34_74,
            'BuccalPalatal_35_75'=> $data->BuccalPalatal_35_75,
            'BuccalPalatal_36'=> $data->BuccalPalatal_36,
            'BuccalPalatal_37'=> $data->BuccalPalatal_37,
            'BuccalPalatal_38'=> $data->BuccalPalatal_38
        
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
        return emrpedodontie_treatmen::where('emrid', $data->emrid)->get();
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
        return emrpedodontie_treatmenplan::where('emrid', $data->emrid)->get();
    }
}