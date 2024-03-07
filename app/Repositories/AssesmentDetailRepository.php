<?php

namespace App\Repositories;

use App\Models\assesmentdetail;
use App\Repositories\Interfaces\AssesmentDetailRepositoryInterface; 
use Illuminate\Support\Facades\DB;
use Tripteki\RequestResponseQuery\QueryBuilder;  

class AssesmentDetailRepository implements AssesmentDetailRepositoryInterface
{
    public function allAssesmentDetail()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(assesmentdetail::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "assesmentgroupid", "assesmentdescription", "active", "updated_at", ])->
        allowedFilters([ "id", "assesmentgroupid", "assesmentdescription", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
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