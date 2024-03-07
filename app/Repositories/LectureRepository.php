<?php

namespace App\Repositories;

use App\Models\lecture;
use App\Repositories\Interfaces\LectureRepositoryInterface; 
use Illuminate\Support\Facades\DB;  
use Tripteki\RequestResponseQuery\QueryBuilder;

class LectureRepository implements LectureRepositoryInterface
{
    public function allLecture()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(lecture::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "nim", "specialistid", "name", "active", "updated_at", ])->
        allowedFilters([ "id", "nim", "specialistid", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function viewallwithotpaging()
    {
        return lecture::all();
    }

    public function storeLecture($request,$uuid)
    {
        return  lecture::insert($request);
    }

    public function findLecture($id)
    {
        return lecture::where('id',$id)->get();
    }
    public function findLecturebyNIM($nim)
    {
        return lecture::where('nim',$nim)->get();
    }
    public function findAssesmentbyGroup($id)
    {
        return lecture::where('assesmentgroupID',$id)->get();
    }

    public function updateLecture($request)
    {
        $updates = lecture::where('id', $request['id'])->update([
            'specialistid' => $request['specialistid'],            
            'nim' => $request['nim'], 
            'name' => $request['name'],             
            'doctotidsimrs' => $request['doctotidsimrs'],  
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroyLecture($id)
    {
        $category = lecture::find($id);
        $category->delete();
    }
}