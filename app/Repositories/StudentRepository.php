<?php

namespace App\Repositories;

use App\Models\hospital;
use App\Models\student;
use App\Models\Year; 
use Illuminate\Support\Facades\DB;  
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder;

class StudentRepository implements StudentRepositoryInterface
{
    public function allStudent()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(student::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "nim", "specialistid", "semesterid", "university", "name", "active", "updated_at", ])->
        allowedFilters([ "id", "nim", "specialistid", "semesterid", "university", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);
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
    public function findStudentbyspecialist($id)
    {
        return Student::where('specialistid',$id)->get();
    }
}