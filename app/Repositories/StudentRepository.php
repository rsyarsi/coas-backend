<?php

namespace App\Repositories;

use App\Models\hospital;
use App\Models\student;
use App\Models\Year; 
use Illuminate\Support\Facades\DB;  
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{

    public function allStudent()
    {
        return student::orderBy('id', 'DESC')->latest()->paginate(10);
    }

    public function viewallwithotpaging()
    {
        return student::orderBy('id', 'DESC')->get();
    }


    public function storeStudent($request,$uuid)
    {
        return  DB::table("students")->insert($request);
    }

    public function findStudent($id)
    {
        return Student::where('id',$id)->get();
    }
    public function findStudentnim($id)
    {
        return Student::where('nim',$id)->get();
    }
    public function findStudentbyNIM($nim)
    {
        return Student::where('nim',$nim)->get();
    }
    public function updateStudent($request)
    {
        $updates = Student::where('id', $request['id'])->update([
            'name'=> $request['name'],      
            'nim'=> $request['nim'],  
            'semesterid'=> $request['semesterid'],          
            'specialistid'=> $request['specialistid'],          
            'datein'=> $request['datein'],          
            'university'=> $request['university'],          
            'hospitalfrom'=> $request['hospitalfrom'],          
            'hospitalto'=> $request['hospitalto'],       
            'active' => $request['active']
        ]);
        return $updates;
    }
 
}