<?php

namespace App\Repositories;
 
use App\Models\AssesmentGroup;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;  

class AssesmentGroupRepository implements AssesmentGroupRepositoryInterface
{
    public function allAssesmentGroup()
    {
        return AssesmentGroup::latest()->paginate(10);
    }

    public function storeAssesmentGroup($request)
    {
        return  DB::table("assesmentgroups")->insert([
            'specialistID' => $request->specialistID,
            'assementgroupname' => $request->assementgroupname, 
            'active' => $request->active 
        ]);
    }

    public function findAssesmentGroup($id)
    {
        return AssesmentGroup::get('id',$id)->get();
    }

    public function updateAssesmentGroup($request)
    {
        $updates = AssesmentGroup::where('id', $request->id)->update([
            'specialistID' => $request->specialistID,
            'assementgroupname' => $request->assementgroupname, 
            'active' => $request->active 
        ]);
        return $updates;
    }

    public function destroyAssesmentGroup($id)
    {
        $category = AssesmentGroup::find($id);
        $category->delete();
    }
}