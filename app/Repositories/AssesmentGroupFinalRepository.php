<?php

namespace App\Repositories;

use App\Models\assesmentgroup;
use App\Models\assesmentgroupfinal;
use App\Repositories\Interfaces\AssesmentGroupFinalRepositoryInterface;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;  

class AssesmentGroupFinalRepository implements AssesmentGroupFinalRepositoryInterface
{
    public function allAssesmentGroupFinal()
    {
        return assesmentgroupfinal::orderBy('id', 'DESC')->latest()->paginate(20);
    }
    public function viewallwithotpaging()
    {
        return assesmentgroupfinal::all();
    }
    public function storeAssesmentGroupFinal($request,$uuid)
    {
        return  DB::table("assesmentgroupfinals")->insert($request);
    }
    
    public function findAssesmentGroupFinal($id)
    {
        return assesmentgroupfinal::where('id',$id)->get();
    }

    public function updateAssesmentGroupFinal($request)
    {
        $updates = assesmentgroupfinal::where('id', $request['id'])->update([
            'name' => $request['name'], 
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroyAssesmentGroupFinal($id)
    {
        $category = assesmentgroupfinal::find($id);
        $category->delete();
    }
     
}