<?php

namespace App\Repositories;
 
use App\Models\Lecture;
use App\Repositories\Interfaces\LectureRepositoryInterface; 
use Illuminate\Support\Facades\DB;  

class LectureRepository implements LectureRepositoryInterface
{
    public function allLecture()
    {
        return Lecture::orderBy('id', 'DESC')->latest()->paginate(10);
    }
    public function viewallwithotpaging()
    {
        return Lecture::all();
    }

    public function storeLecture($request,$uuid)
    {
        return  Lecture::insert($request);
    }

    public function findLecture($id)
    {
        return Lecture::where('id',$id)->get();
    }
    public function findLecturebyNIM($nim)
    {
        return Lecture::where('nim',$nim)->get();
    }
    public function findAssesmentbyGroup($id)
    {
        return Lecture::where('assesmentgroupID',$id)->get();
    }

    public function updateLecture($request)
    {
        $updates = Lecture::where('id', $request['id'])->update([
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
        $category = Lecture::find($id);
        $category->delete();
    }
}