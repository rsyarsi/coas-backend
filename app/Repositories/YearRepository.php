<?php

namespace App\Repositories;

use App\Models\Year;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\YearRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder;

class YearRepository implements YearRepositoryInterface
{
    public function allYears()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(Year::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "name", "active", "updated_at", ])->
        allowedFilters([ "id", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function allYearswithoutPaging()
    {
        return Year::all();
    }
    public function storeYears($request,$uuid)
    {
        return  DB::table("years")->insert($request);
    }

    public function findYears($id)
    {
        return Year::where('id',$id)->get();
    }

    public function updateYears($request)
    {
        $updates = Year::where('id', $request['id'])->update($request);
        return $updates;
    }

    public function destroyYears($id)
    {
        $category = Year::find($id);
        $category->delete();
    }
}