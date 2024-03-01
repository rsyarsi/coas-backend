<?php

namespace App\Repositories;

use App\Models\lecture;
use App\Repositories\Interfaces\LectureRepositoryInterface; 
use Illuminate\Support\Facades\DB;  

class LectureRepository implements LectureRepositoryInterface
{
    public function allLecture()
    {
        return lecture::orderBy('id', 'DESC')->latest()->paginate(10);
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