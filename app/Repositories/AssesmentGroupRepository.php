<?php

namespace App\Repositories;
 
use App\Models\AssesmentGroup;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;  

class AssesmentGroupRepository implements AssesmentGroupRepositoryInterface
{
    public function allAssesmentGroup()
    {
        return AssesmentGroup::orderBy('id', 'DESC')->latest()->paginate(20);
    }
    public function viewallwithotpaging()
    {
        return AssesmentGroup::all();
    }
    public function storeAssesmentGroup($request,$uuid)
    {
        return  DB::table("assesmentgroups")->insert($request);
    }

    public function findAssesmentGroup($id)
    {
        return AssesmentGroup::where('id',$id)->get();
    }

    public function updateAssesmentGroup($request)
    {
        $updates = AssesmentGroup::where('id', $request['id'])->update([
            'specialistid' => $request['specialistid'],
            'assementgroupname' => $request['assementgroupname'],             
            'valuetotal' => $request['valuetotal'],  
            'type' => $request['type'],  
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroyAssesmentGroup($id)
    {
        $category = AssesmentGroup::find($id);
        $category->delete();
    }
}