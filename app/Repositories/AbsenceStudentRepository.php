<?php

namespace App\Repositories;

use App\Models\absencestudent;
use App\Models\AssesmentDetail;
use App\Repositories\Interfaces\AbsenceStudentRepositoryInterface; 
use Illuminate\Support\Facades\DB;  

class AbsenceStudentRepository implements AbsenceStudentRepositoryInterface
{
    public function allAbsenceStudent()
    {
        return absencestudent::orderBy('id', 'DESC')->latest()->paginate(10);
    }
    public function viewallwithotpaging()
    {
        return AbsenceStudent::all();
    }
    public function storeAbsenceStudent($request,$uuid)
    {
        return  AbsenceStudent::insert($request);
    }

    public function findAbsenceStudent($id)
    {
        return AbsenceStudent::where('id',$id)->get();
    }

    public function findbydate($request){
        return absencestudent::where('date',$request->date)
        ->where('studentid',$request->studentid)        
        ->get();
    }

    public function absenceperiodemonth($request){
        return absencestudent::where('periode',$request->periode)
        ->where('studentid',$request->studentid)        
        ->get();
    }

    public function updateAbsenceStudentIn($request)
    {
      
        $updates = absencestudent::where('id', $request['id'])->update([
            'studentid' => $request['studentid'],
            'time_in' => $request['time_in'],  
            'periode' => $request['periode'],      
            'date' => $request['date'] 
        ]);
        return $updates;
    }
    public function updateAbsenceStudentOut($request)
    {
      
        $updates = absencestudent::where('id', $request['id'])->update([
            'studentid' => $request['studentid'],
            'time_out' => $request['time_out'], 
            'periode' => $request['periode'],    
            'date' => $request['date'] 
        ]);
        return $updates;
    }
}