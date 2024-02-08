<?php

namespace App\Repositories;
 
use App\Models\Lecture;
use App\Repositories\Interfaces\LectureRepositoryInterface; 
use Illuminate\Support\Facades\DB;  

class LectureRepository implements LectureRepositoryInterface
{
    public function allLecture()
    {
        return Lecture::latest()->paginate(10);
    }

    public function storeLecture($request)
    {
        return  Lecture::insert([
            'specialistID' => $request->specialistID,
            'name' => $request->name,             
            'doctotidsimrs' => $request->doctotidsimrs,  
            'active' => $request->active 
        ]);
    }

    public function findLecture($id)
    {
        return Lecture::where('id',$id)->get();
    }

    public function findAssesmentbyGroup($id)
    {
        return Lecture::where('assesmentgroupID',$id)->get();
    }

    public function updateLecture($request)
    {
        $updates = Lecture::where('id', $request->id)->update([
            'specialistID' => $request->specialistID,
            'name' => $request->name,             
            'doctotidsimrs' => $request->doctotidsimrs,  
            'active' => $request->active 
        ]);
        return $updates;
    }

    public function destroyLecture($id)
    {
        $category = Lecture::find($id);
        $category->delete();
    }
}