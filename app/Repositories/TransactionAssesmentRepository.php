<?php

namespace App\Repositories;

use App\Models\hospital;
use App\Models\student;
use App\Models\trsassesment;
use App\Models\type_five_trsdetailassesment;
use App\Models\type_four_trsdetailassesment;
use App\Models\type_one_trsdetailassesment;
use App\Models\type_three_trsdetailassesment;
use App\Models\Year; 
use Illuminate\Support\Facades\DB;  
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TransactionAssesmentRepositoryInterface;

class TransactionAssesmentRepository implements TransactionAssesmentRepositoryInterface
{
    public function storeTrsAssesment($request,$uuid)
    {
        return  DB::table("trsassesments")->insert($request);

         
    } 
    public function findassesmentbygrouptype($request,$type){
        return  DB::table("viewassesmentdetailbygrouptypes")
        ->where('activeassesmentgroups','1') 
        ->where('activeassesmentdetails','1') 
        ->where('activespecialists','1') 
        ->where('assesmentgroupid',$request->assesmentgroupid)  
        ->where('assesmentgrouptype',$type)    
        ->get();
    }
    public function verifyTrsAssesment($request,$assesmenttype)
    {
        return trsassesment::where('assesmentgroupid',$request->assesmentgroupid)
        ->where('studentid',$request->studentid) 
        ->where('lectureid',$request->lectureid)
        ->where('yearid',$request->yearid)
        ->where('semesterid',$request->semesterid)
        ->where('specialistid',$request->specialistid)
        ->where('assesmenttype',$assesmenttype)
        ->get();
    }
    public function storeTrsAssesmentDetailone($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_one_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,   
            'transactiondate'=> $date,   
            'assesmentskala'=> $key->assesmentskalavalue,   
            'assesmentbobotvalue'=> $key->assesmentbobotvalue,   
            'assementscore'=> '0',
            'active' => '1'
        ]);
    }
    public function storeTrsAssesmentDetailthree($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_three_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,   
            'transactiondate'=> $date,   
            'assementskala'=> $key->assementskala,   
            'assementbobotvalue'=> $key->assementbobotvalue,   
            'assessmentvalue'=> $key->assessmentvalue,   
            'konditevalue'=> $key->konditevalue,   
            'assementscore'=> '0',
            'active' => '1'
        ]);
    }
    public function storeTrsAssesmentDetailfour($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_four_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,   
            'transactiondate'=> $date,   
            'assementskala'=> $key->assementskala,    
            'assessmentvalue'=> $key->assessmentvalue,   
            'assementscore'=> '0', 
            'active' => '1'
        ]);
    }
    public function storeTrsAssesmentDetailfive($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_five_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,   
            'transactiondate'=> $date,   
            'assesmentvalue'=> $key->assesmentvalue,     
            'assementscore'=> '0', 
            'active' => '1'
        ]);
    }
    public function findTrsAssesmentDetailone($uuid){
        return type_one_trsdetailassesment::where('trsassesmentid',$uuid)->get();
    }
    public function findTrsAssesmentDetailthree($uuid){
        return type_three_trsdetailassesment::where('trsassesmentid',$uuid)->get();
    }
    public function findTrsAssesmentDetailfour($uuid){
        return type_four_trsdetailassesment::where('trsassesmentid',$uuid)->get();
    }
    public function findTrsAssesmentDetailfive($uuid){
        return type_five_trsdetailassesment::where('trsassesmentid',$uuid)->get();
    }
}