<?php

namespace App\Repositories;

use App\Models\hospital;
use App\Models\Year; 
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder;

class HospitalRepository implements HospitalRepositoryInterface
{

    public function allHospital()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(hospital::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "name", "active", "updated_at", ])->
        allowedFilters([ "id", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }

    public function viewallwithotpaging()
    {
        return hospital::all();
    }


    public function storeHospital($request,$uuid)
    {
        return  DB::table("hospitals")->insert($request);
    }

    public function findHospital($id)
    {
        return hospital::where('id',$id)->get();
    }

    public function updateHospital($request)
    {
        $updates = hospital::where('id', $request['id'])->update([
            'name' => $request['name'],
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroyHospital($id)
    {
        $category = hospital::find($id);
        $category->delete();
    }
}