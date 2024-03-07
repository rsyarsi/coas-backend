<?php

namespace App\Repositories;
 
use App\Models\Semester;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\SemesterRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder;

class SemesterRepository implements SemesterRepositoryInterface
{
    public function allSemester()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(Semester::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "semestername", "active", "updated_at", ])->
        allowedFilters([ "id", "semestername", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function allSemesterwithoutpaging()
    {
        return Semester::all();
    }

    public function storeSemester($request,$uuid)
    {
        return  DB::table("semesters")->insert($request);
    }

    public function findSemester($id)
    {
        return Semester::where('id',$id)->get();
    }

    public function updateSemester($request)
    {
        $updates = Semester::where('id', $request['id'])->update([
            'semestername' => $request['semestername'],
            'semestervalue' => $request['semestervalue'], 
            'active' => $request['active']  
        ]);
        return $updates;
    }

    public function destroySemester($id)
    {
        $category = Semester::find($id);
        $category->delete();
    }
}