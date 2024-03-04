<?php

namespace App\Repositories;

use App\Models\assesmentgroup;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;  

class AssesmentGroupRepository implements AssesmentGroupRepositoryInterface
{
    public function allAssesmentGroup()
    {
        return assesmentgroup::orderBy('id', 'DESC')->latest()->paginate(20);
    }
    public function viewallwithotpaging()
    {
        return assesmentgroup::all();
    }
    public function storeAssesmentGroup($request,$uuid)
    {
        return  DB::table("assesmentgroups")->insert($request);
    }
    
    public function findAssesmentGroup($id)
    {
        return assesmentgroup::where('id',$id)->get();
    }

    public function updateAssesmentGroup($request)
    {
        $updates = assesmentgroup::where('id', $request['id'])->update([
            'specialistid' => $request['specialistid'],
            'assementgroupname' => $request['assementgroupname'],             
            'idassesmentgroupfinal' => $request['idassesmentgroupfinal'],            
            'isskala' => $request['isskala'],  
            'valuetotal' => $request['valuetotal'],   
            'type' => $request['type'],  
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroyAssesmentGroup($id)
    {
        $category = assesmentgroup::find($id);
        $category->delete();
    }
    public function findAssesmentGroupbyspecialist($id)
    {
        return assesmentgroup::where('specialistid',$id)->get();
    }
}