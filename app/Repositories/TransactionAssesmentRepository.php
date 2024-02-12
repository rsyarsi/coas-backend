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
    public function findtrsbyid($request){
        return trsassesment::where('id',$request->id);
    }
    public function findtrsassesmentbyidandGroupId($request){
        return trsassesment::where('id',$request->id)
        ->where('assesmentgroupid',$request->assesmentgroupid)
        ->get();
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
            'assesmentskala'=> $key->assesmentskalavalue,   
            'assesmentbobotvalue'=> $key->assesmentbobotvalue,   
            'assementvalue'=> '0',            
            'assementscore'=> '0', 
            'active' => '1'
        ]);
    }
    public function updateTrsAssesmentDetailone($key)
    { 
   
        $updates = type_one_trsdetailassesment::where('id', $key['iddetail'])->update([
            'assementvalue'=> $key['assementvalue'],      
            'transactiondate'=> $key['dateupdatedetail'],      
            'assementscore'=> $key['assesmentbobotvalue']*$key['assementvalue']
        ]);
        return $updates;
    }
   
    public function storeTrsAssesmentDetailthree($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_three_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,   
            'assesmentskala'=> $key->assesmentskalavalue,   
            'assesmentbobotvalue'=> $key->assesmentbobotvalue,    
            'konditevalue'=> $key->assesmentkonditevalue,   
            'assementvalue'=> '0',  
            'assesmentscore'=> '0',
            'active' => '1'
        ]);
    }
    public function updateTrsAssesmentDetailthree($key)
    { 
   
        $updates = type_three_trsdetailassesment::where('id', $key['iddetail'])->update([
            'assementvalue'=> $key['assementvalue'],      
            'transactiondate'=> $key['dateupdatedetail'],              
            'konditevalue'=> $key['konditevalue'],   
            'assementscore'=> $key['assesmentbobotvalue']*$key['assementvalue']
        ]);
        return $updates;
    }
    public function storeTrsAssesmentDetailfour($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_four_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,    
            'assesmentskala'=> $key->assesmentskalavalue, 
            'assementvalue'=> '0',     
            'assementscore'=> '0', 
            'active' => '1'
        ]);
    }
    public function updateTrsAssesmentDetailfour($key)
    { 
   
        $updates = type_four_trsdetailassesment::where('id', $key['iddetail'])->update([
            'assementvalue'=> $key['assementvalue'],      
            'transactiondate'=> $key['dateupdatedetail'],              
            'assesmentskala'=> $key['assesmentskala'],   
            'assementscore'=> $key['assementvalue']
        ]);
        return $updates;
    }
    public function storeTrsAssesmentDetailfive($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_five_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,       
            'assesmentbobotvalue'=> $key->assesmentbobotvalue,  
            'assementvalue'=> '0',    
            'assesmentscore'=> '0', 
            'active' => '1'
        ]);
    }
    public function updateTrsAssesmentDetailfive($key)
    { 
   
        $updates = type_four_trsdetailassesment::where('id', $key['iddetail'])->update([
            'assementvalue'=> $key['assementvalue'],      
            'transactiondate'=> $key['dateupdatedetail'],       
            'assementscore'=> $key['assesmentbobotvalue']*$key['assementvalue']
        ]);
        return $updates;
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
    
    public function findTrsAssesmentDetailonebyId($uuid){
        return type_one_trsdetailassesment::where('id',$uuid)->get();
    }
    public function findTrsAssesmentDetailthreebyId($uuid){
        return type_three_trsdetailassesment::where('id',$uuid)->get();
    }
    public function findTrsAssesmentDetailfourbyId($uuid){
        return type_four_trsdetailassesment::where('id',$uuid)->get();
    }
    public function findTrsAssesmentDetailfivebyId($uuid){
        return type_five_trsdetailassesment::where('id',$uuid)->get();
    }

    public function sumTrsAssesmentDetailonebyIdTransaksiHeader($uuid){
        return type_one_trsdetailassesment::where('trsassesmentid',$uuid)->sum('assementscore');
    }
    public function updateTrsAssesmentHeader($request,$scoretotal)
    { 
   
        $updates = trsassesment::where('id', $request->id)->update([
            'grandotal'=> $scoretotal
        ]);
        return $updates;
    }
}