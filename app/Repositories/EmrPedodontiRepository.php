<?php

namespace App\Repositories;

use App\Models\emrpedodontie;
use App\Models\hospital;
use App\Models\Year;
use App\Repositories\Interfaces\EmrPedodontiRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\HospitalRepositoryInterface;

class EmrPedodontiRepository implements EmrPedodontiRepositoryInterface
{
    public function createmedicaldentalhistory($request, $uuid)
    {
        return  DB::table("emrpedodonties")->insert($request);
    }
    public function createbehaviorrating($data)
    {
        return  DB::table("emrpedodontie_behaviorratings")->insert($data);
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
}