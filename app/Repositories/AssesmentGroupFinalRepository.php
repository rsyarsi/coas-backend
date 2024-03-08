<?php

namespace App\Repositories;

use App\Models\assesmentgroup;
use App\Models\assesmentgroupfinal;
use App\Repositories\Interfaces\AssesmentGroupFinalRepositoryInterface;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Tripteki\RequestResponseQuery\QueryBuilder;  

class AssesmentGroupFinalRepository implements AssesmentGroupFinalRepositoryInterface
{
    public function allAssesmentGroupFinal()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(assesmentgroupfinal::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "specialistid", "name", "active", "updated_at", ])->
        allowedFilters([ "id", "specialistid", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
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
            'active' => $request['active'],
            'specialistid' => $request['specialistid'],
            'bobotvaluefinal' => $request['bobotvaluefinal'],
        ]);
        return $updates;
    }

    public function destroyAssesmentGroupFinal($id)
    {
        $category = assesmentgroupfinal::find($id);
        $category->delete();
    }
    public function findAssesmentGroupbyspecialist($id)
    {
        return assesmentgroupfinal::where('specialistid',$id)->get();
    }
     
}