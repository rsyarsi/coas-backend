<?php

namespace App\Repositories;
 
use App\Models\Semester;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\SemesterRepositoryInterface;

class SemesterRepository implements SemesterRepositoryInterface
{
    public function allSemester()
    {
        return Semester::orderBy('id', 'DESC')->latest()->paginate(10);
    }
    public function allSemesterwithoutpaging()
    {
        return Semester::where('active','1')->get();
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