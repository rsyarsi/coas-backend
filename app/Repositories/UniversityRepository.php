<?php

namespace App\Repositories;

use App\Models\universitie;
use App\Models\University; 
use Illuminate\Support\Facades\DB;  
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder;

class UniversityRepository implements UniversityRepositoryInterface
{

    public function allUniversity()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(universitie::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "name", "active", "updated_at", ])->
        allowedFilters([ "id", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }

    public function viewallwithotpaging()
    {
        return universitie::all();
    }

    public function storeUniversity($request,$uuid)
    {
        return  DB::table("universities")->insert($request);
    }

    public function findUniversity($id)
    {
        return universitie::where('id',$id)->get();
    }

    public function updateUniversity($request)
    {
        $updates = universitie::where('id', $request['id'])->update([
            'name' => $request['name'],
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroyUniversity($id)
    {
        $category = universitie::find($id);
        $category->delete();
    }
}