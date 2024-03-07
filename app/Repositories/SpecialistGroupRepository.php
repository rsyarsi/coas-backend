<?php

namespace App\Repositories;

use App\Models\specialistgroup;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder; 

class SpecialistGroupRepository implements SpecialistGroupRepositoryInterface
{
    public function allSpecialistGroup()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(specialistgroup::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "name", "active", "updated_at", ])->
        allowedFilters([ "id", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function viewallwithotpaging()
    {
        return specialistgroup::all();
    }

    public function storeSpecialistGroup($request,$uuid)
    {
        return  DB::table("specialistgroups")->insert($request);
    }

    public function findSpecialistGroup($id)
    {
        return specialistgroup::where('id',$id)->get();
    }

    public function updateSpecialistGroup($request)
    {
        $updates = specialistgroup::where('id', $request->id)->update([
            'name' => $request->name,
            'active' => $request->active 
        ]);
        return $updates;
    }

    public function destroySpecialistGroup($id)
    {
        $category = specialistgroup::find($id);
        $category->delete();
    }
}