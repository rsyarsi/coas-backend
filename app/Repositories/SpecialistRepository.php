<?php

namespace App\Repositories;

use App\Models\specialist; 
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder;

class SpecialistRepository implements SpecialistRepositoryInterface
{
    public function allSpecialist()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(specialist::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "groupspecialistid", "specialistname", "active", "updated_at", ])->
        allowedFilters([ "id", "groupspecialistid", "specialistname", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function viewallwithotpaging()
    {
        return specialist::all();
    }
    public function storeSpecialist($request,$uuid)
    {
        return  DB::table("specialists")->insert($request);
    }

    public function findSpecialist($id)
    {
        return specialist::where('id',$id)->get();
    }

    public function updateSpecialist($request)
    {
        $updates = specialist::where('id', $request['id'])->update([
            'specialistname' => $request['specialistname'],
            'groupspecialistid' => $request['groupspecialistid'], 
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroySpecialist($id)
    {
        $category = specialist::find($id);
        $category->delete();
    }
}