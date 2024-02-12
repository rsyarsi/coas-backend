<?php

namespace App\Repositories;
 
use App\Models\AssesmentGroup;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;  

class AssesmentGroupRepository implements AssesmentGroupRepositoryInterface
{
    public function allAssesmentGroup()
    {
        return AssesmentGroup::latest()->paginate(20);
    }
    public function viewallwithotpaging()
    {
        return AssesmentGroup::where('active','1')->get();
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