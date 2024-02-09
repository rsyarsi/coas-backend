<?php

namespace App\Repositories;

use App\Models\hospital;
use App\Models\student;
use App\Models\Year; 
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{

    public function allStudent()
    {
        return student::latest()->paginate(10);
    }

    public function storeStudent($request)
    {
        return  DB::table("students")->insert([
            'name'=> $request->name,      
            'nim'=> $request->nim, 
            'semesterID'=> $request->semesterID,         
            'specialistID'=> $request->specialistID,         
            'dateIn'=> $request->dateIn,         
            'university'=> $request->university,         
            'hospitalfrom'=> $request->hospitalfrom,         
            'hospitalto'=> $request->hospitalto,      
            'active' => $request->active
        ]);
    }

    public function findStudent($id)
    {
        return Student::where('id',$id)->get();
    }

    public function updateStudent($request)
    {
        $updates = Student::where('id', $request->id)->update([
            'name'=> $request->name,      
            'nim'=> $request->nim, 
            'semesterID'=> $request->semesterID,         
            'specialistID'=> $request->specialistID,         
            'dateIn'=> $request->dateIn,         
            'university'=> $request->university,         
            'hospitalfrom'=> $request->hospitalfrom,         
            'hospitalto'=> $request->hospitalto,      
            'active' => $request->active
        ]);
        return $updates;
    }

    public function destroyStudent($id)
    {
        $category = Student::find($id);
        $category->delete();
    }
}