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
            'overretainedprimarytooth' => $data->overretainedprimarytooth
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