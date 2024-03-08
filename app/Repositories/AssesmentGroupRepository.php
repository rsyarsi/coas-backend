<?php

namespace App\Repositories;

use App\Models\assesmentgroup;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Tripteki\RequestResponseQuery\QueryBuilder;  

class AssesmentGroupRepository implements AssesmentGroupRepositoryInterface
{
    public function allAssesmentGroup()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(assesmentgroup::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "specialistid", "assementgroupname", "active", "type", "updated_at", ])->
        allowedFilters([ "id", "specialistid", "assementgroupname", "active", "type", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
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
            'bobotprosenfinal' => $request['bobotprosenfinal'], 
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