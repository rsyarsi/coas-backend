<?php

namespace App\Repositories;
 
use App\Models\AssesmentDetail;
use App\Repositories\Interfaces\AssesmentDetailRepositoryInterface; 
use Illuminate\Support\Facades\DB;  

class AssesmentDetailRepository implements AssesmentDetailRepositoryInterface
{
    public function allAssesmentDetail()
    {
        return AssesmentDetail::latest()->paginate(10);
    }

    public function storeAssesmentDetail($request)
    {
        return  AssesmentDetail::insert([
            'assesmentgroupID' => $request->assesmentgroupID,
            'assementdescription' => $request->assementdescription,             
            'assementbobotvalue' => $request->assementbobotvalue,  
            'active' => $request->active 
        ]);
    }

    public function findAssesmentDetail($id)
    {
        return AssesmentDetail::where('id',$id)->get();
    }

    public function findAssesmentbyGroup($id)
    {
        return AssesmentDetail::where('assesmentgroupID',$id)->get();
    }

    public function updateAssesmentDetail($request)
    {
        $updates = AssesmentDetail::where('id', $request->id)->update([
            'assesmentgroupID' => $request->assesmentgroupID,
            'assementdescription' => $request->assementdescription,             
            'assementbobotvalue' => $request->assementbobotvalue,  
            'active' => $request->active 
        ]);
        return $updates;
    }

    public function destroyAssesmentDetail($id)
    {
        $category = AssesmentDetail::find($id);
        $category->delete();
    }
}