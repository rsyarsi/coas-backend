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

    public function storeAssesmentDetail($request,$uuid)
    {
        return  AssesmentDetail::insert($request);
    }

    public function findAssesmentDetail($id)
    {
        return AssesmentDetail::where('id',$id)->get();
    }

    public function findAssesmentbyGroup($id)
    {
        return AssesmentDetail::where('assesmentgroupid',$id)->get();
    }

    public function updateAssesmentDetail($request)
    {
      
        $updates = AssesmentDetail::where('id', $request['id'])->update([
            'assesmentgroupid' => $request['assesmentgroupid'],
            'assesmentdescription' => $request['assesmentdescription'],             
            'assesmentbobotvalue' => $request['assesmentbobotvalue'],  
            'assesmentskalavalue' => $request['assesmentskalavalue'],  
            'active' => $request['active'] 
        ]);
        return $updates;
    }

    public function destroyAssesmentDetail($id)
    {
        $category = AssesmentDetail::find($id);
        $category->delete();
    }
}