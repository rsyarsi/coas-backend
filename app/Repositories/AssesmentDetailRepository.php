<?php

namespace App\Repositories;

use App\Models\assesmentdetail;
use App\Repositories\Interfaces\AssesmentDetailRepositoryInterface; 
use Illuminate\Support\Facades\DB;  

class AssesmentDetailRepository implements AssesmentDetailRepositoryInterface
{
    public function allAssesmentDetail()
    {
        return assesmentdetail::orderBy('id', 'DESC')->latest()->paginate(10);
    }
    public function viewallwithotpaging()
    {
        return assesmentdetail::all();
    }
    public function storeAssesmentDetail($request,$uuid)
    {
        return  assesmentdetail::insert($request);
    }

    public function findAssesmentDetail($id)
    {
        return assesmentdetail::where('id',$id)->get();
    }

    public function findAssesmentbyGroup($id)
    {
        return assesmentdetail::where('assesmentgroupid',$id)->get();
    }

    public function updateAssesmentDetail($request)
    {
      
        $updates = assesmentdetail::where('id', $request['id'])->update([
            'assesmentgroupid' => $request['assesmentgroupid'],
            'assesmentnumbers' => $request['assesmentnumbers'],
            'assesmentdescription' => $request['assesmentdescription'], 
            'kode_sub_name' =>['kode_sub_name'],
            'assesmentbobotvalue' => $request['assesmentbobotvalue'], 
            'assesmentvaluestart' => $request['assesmentvaluestart'], 
            'assesmentvalueend' => $request['assesmentvalueend'], 
            'assesmentskalavalue' => $request['assesmentskalavalue'],  
            'assesmentskalavaluestart' => $request['assesmentskalavaluestart'], 
            'assesmentskalavalueend' => $request['assesmentskalavalueend'], 
            'assesmentkonditevalue' => $request['assesmentkonditevalue'], 
            'assesmentkonditevaluestart' => $request['assesmentkonditevaluestart'], 
            'assesmentkonditevalueend' => $request['assesmentkonditevalueend'],
            'kodesub' => $request['kodesub'],   
            'index_sub' => $request['index_sub'],   
            'active' => $request['active'] 
        ]);
        return $updates;
    }

    public function destroyAssesmentDetail($id)
    {
        $category = assesmentdetail::find($id);
        $category->delete();
    }

    public function validateSubAssesment($request){
        return assesmentdetail::where('assesmentgroupid', $request->assesmentgroupid)
        ->where('kodesub', $request->index_sub)        
        ->where('active', '1')
        ->get();
    }

}