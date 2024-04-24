<?php

namespace App\Repositories;

use App\Models\hospital;
use App\Models\student;
use App\Models\trsassesment;
use App\Models\type_five_trsdetailassesment;
use App\Models\type_four_trsdetailassesment;
use App\Models\type_one_control_trsdetailassesment;
use App\Models\type_one_trsdetailassesment;
use App\Models\type_three_trsdetailassesment;
use App\Models\Year; 
use Illuminate\Support\Facades\DB;  
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TransactionAssesmentRepositoryInterface;
use Carbon\Carbon;

class TransactionAssesmentRepository implements TransactionAssesmentRepositoryInterface
{
    public function storeTrsAssesment($request,$uuid)
    {
        return  DB::table("trsassesments")->insert($request);
    } 
    public function findtrsbyid($id){
        return trsassesment::where('id',$id);
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
        ->orderBy('index_sub', 'ASC')        
        ->orderBy('assesmentnumbers', 'ASC') 
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
            'kodesub'=> $key->kodesub,   
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
    public function storeTrsAssesmentDetailoneControl($key,$uuidheader,$uuiddetail,$date)
    { 
   
        return  type_one_control_trsdetailassesment::insert([
            'id'=> $uuiddetail,      
            'trsassesmentid'=> $uuidheader,  
            'assesmentdetailid'=> $key->assesmentdetailid,   
            'assesmentdescription'=> $key->assesmentdescription,     
            'controlaction'=> '',    
            'assementvalue'=> '0', 
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
            'assesmentskala'=> $key->assesmentskalavalue,   
            'assesmentbobotvalue'=> $key->assesmentbobotvalue,    
            'konditevalue'=> $key->assesmentkonditevalue,
            'kodesub'=> $key->kodesub,   
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
            'assesmentscore'=> $key['assesmentbobotvalue']*$key['assementvalue']
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
            'kodesub'=> $key->kodesub,
            'assementvalue'=> '0',     
            'assesmentscore'=> '0', 
            'active' => '1'
        ]);
    }
    public function updateTrsAssesmentDetailfour($request)
    { 
   
        $updates = type_four_trsdetailassesment::where('id', $request->iddetail)->update([
            'assementvalue'=> $request->assementvalue,      
            'transactiondate'=> $request->dateupdatedetail,              
            'assesmentskala'=> $request->assesmentskala,   
            'assesmentscore'=> $request->assementvalue
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
            'kodesub'=> $key->kodesub,
            'assementvalue'=> '0',    
            'assesmentscore'=> '0', 
            'active' => '1'
        ]);
    }
    public function updateTrsAssesmentDetailfive($key)
    { 
   
        $updates = type_five_trsdetailassesment::where('id', $key['iddetail'])->update([
            'assementvalue'=> $key['assementvalue'],      
            'transactiondate'=> $key['dateupdatedetail'],       
            'assesmentscore'=> $key['assesmentbobotvalue']*$key['assementvalue']
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
    public function findTrsAssesmentDetailoneControl($uuid){
        return type_one_control_trsdetailassesment::where('trsassesmentid',$uuid)->get();
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
        return type_one_trsdetailassesment::where('trsassesmentid',$uuid)
        ->where('kodesub', '0')
        ->sum('assementscore');
    }
    public function sumTrsAssesmentDetailthreebyIdTransaksiHeader($uuid){
        return type_three_trsdetailassesment::where('trsassesmentid',$uuid)
        ->where('kodesub', '0')
        ->sum('assesmentscore');
    }
    public function sumTrsAssesmentDetailfourbyIdTransaksiHeader($uuid){
        return type_four_trsdetailassesment::where('trsassesmentid',$uuid)
        ->where('kodesub', '0')
        ->sum('assesmentscore');
    }
    public function sumTrsAssesmentDetailfivebyIdTransaksiHeader($uuid){
        return type_five_trsdetailassesment::where('trsassesmentid',$uuid)
        ->where('kodesub', '0')
        ->sum('assesmentscore');
    }
    public function sumTrsAssesmentDetailonebyIdTransaksiSub($request){
        return DB::table("trsassesmentdetailtypeone")->where('trsassesmentid',$request->idhdr)
        ->where('index_sub', $request->index_sub)
        ->where('kodesub', '0')
        ->sum('assementscore');
    }
    public function sumTrsAssesmentDetailthreebyIdTransaksiSub($request){
        return DB::table("trsassesmentdetailtypethree")->where('trsassesmentid',$request->idhdr)
        ->where('index_sub', $request->index_sub)
        ->where('kodesub', '0')
        ->sum('assementscore');
    }
    public function sumTrsAssesmentDetailfourbyIdTransaksiSub($request){
        return DB::table("trsassesmentdetailtypefour")->where('trsassesmentid',$request->idhdr)
        ->where('index_sub', $request->index_sub)
        ->where('kodesub', '0')
        ->sum('assementscore');
    }
    public function sumTrsAssesmentDetailfivebyIdTransaksiSub($request){
        return DB::table("trsassesmentdetailtypefive")->where('trsassesmentid',$request->idhdr)
        ->where('index_sub', $request->index_sub)
        ->where('kodesub', '0')
        ->sum('assementscore');
    }
    public function updateTrsAssesmentsub($request,$scoretotal)
    { 
        $updates = type_one_trsdetailassesment::where('trsassesmentid', $request->idhdr)
        ->where('kodesub', $request->index_sub)
        ->update([
            'assementscore'=> $scoretotal
        ]);
        return $updates;
    }
    public function updateTrsAssesmentsubthree($request,$scoretotal)
    { 
        $updates = type_three_trsdetailassesment::where('trsassesmentid', $request->idhdr)
        ->where('kodesub', $request->index_sub)
        ->update([
            'assesmentscore'=> $scoretotal
        ]);
        return $updates;
    }
    public function updateTrsAssesmentsubfour($request,$scoretotal)
    { 
        $updates = type_four_trsdetailassesment::where('trsassesmentid', $request->idhdr)
        ->where('kodesub', $request->index_sub)
        ->update([
            'assesmentscore'=> $scoretotal
        ]);
        return $updates;
    }
    public function updateTrsAssesmentsubfive($request,$scoretotal)
    { 
        $updates = type_five_trsdetailassesment::where('trsassesmentid', $request->idhdr)
        ->where('kodesub', $request->index_sub)
        ->update([
            'assesmentscore'=> $scoretotal
        ]);
        return $updates;
    }
    public function updateTrsAssesmentHeader($id,$scoretotal,$totalnilai)
    { 
   
        $updates = trsassesment::where('id', $id)->update([
            'grandotal'=> $scoretotal,
            'assesmentfinalvalue'=> $totalnilai,
        ]);
        return $updates;
    }
    public function updateTrsAssesmentHeaderfour($id,$scoretotal,$totalnilai)
    { 
   
        $updates = trsassesment::where('id', $id)->update([
            'grandotal'=> $scoretotal,
            'assesmentfinalvalue'=> $totalnilai,
        ]);
        return $updates;
    }
    // detail sudah oke4
    public function findFilledTrsAssesmentDetailonebyId($id){
        return  DB::table("trsassesmentdetailtypeone")->where('trsassesmentid',$id)->orderBy('index_sub', 'ASC')->orderBy('assesmentnumbers', 'ASC')->latest()->paginate(10);
    }
    public function findFilledTrsAssesmentDetailthreebyId($id){
        return DB::table("trsassesmentdetailtypethree")->where('trsassesmentid',$id)->orderBy('index_sub', 'ASC')->orderBy('assesmentnumbers', 'ASC')->latest()->paginate(10);
    }
    public function findFilledTrsAssesmentDetailfourbyId($id){
        return DB::table("trsassesmentdetailtypefour")->where('trsassesmentid',$id)->orderBy('index_sub', 'ASC')->orderBy('assesmentnumbers', 'ASC')->latest()->paginate(10);
    }
    public function findFilledTrsAssesmentDetailfivebyId($id){
        return DB::table("trsassesmentdetailtypefive")->where('trsassesmentid',$id)->orderBy('index_sub', 'ASC')->orderBy('assesmentnumbers', 'ASC')->latest()->paginate(10);
    }
    public function updateTrsAssesmentHeaderTotalBobot($request,$totalbobot)
    { 
   
        $updates = trsassesment::where('id', $request->id)->update([
            'totalbobot'=> $totalbobot
        ]);
        return $updates;
    }
    public function viewtrsassesmentheaderbyid($request){
        return  DB::table("viewtrsassesmentheader")->where('id',$request->id)->where('active','1');
    }
    // detail sudah oke no paging
    public function findFillednoPagingTrsAssesmentDetailonebyId($id){
        return  DB::table("trsassesmentdetailtypeone")->where('id',$id)->get();
    }
    public function findFillednoPagingTrsAssesmentDetailthreebyId($id){
        return DB::table("trsassesmentdetailtypethree")->where('id',$id)->get();
    }
    public function findFillednoPagingTrsAssesmentDetailfourbyId($id){
        return DB::table("trsassesmentdetailtypefour")->where('id',$id)->get();
    }
    public function findFillednoPagingTrsAssesmentDetailfivebyId($id){
        return DB::table("trsassesmentdetailtypefive")->where('id',$id)->get();
    }
    public function updateTrsAssesmentDetailoneSingle($request)
    { 
   
        $updates = type_one_trsdetailassesment::where('id', $request->id)->update([
            'assementvalue'=> $request->assementvalue,      
            'transactiondate'=> $request->dateupdatedetail,      
            'assementscore'=> $request->assesmentbobotvalue*$request->assementvalue
        ]);
        return $updates;
    }
    public function updateTrsAssesmentDetailthreeSingle($request)
    { 
   
        $updates = type_three_trsdetailassesment::where('id', $request->id)->update([
            'assementvalue'=> $request->assementvalue,      
            'transactiondate'=> $request->dateupdatedetail,              
            'konditevalue'=> $request->konditevalue,   
            'assesmentscore'=> $request->assementvalue
        ]);
        return $updates;
    }
    public function updateTrsAssesmentDetailfourSingle($request)
    { 
   
        $updates = type_four_trsdetailassesment::where('id', $request->id)->update([
            'assementvalue'=> $request->assementvalue,      
            'transactiondate'=> $request->dateupdatedetail,              
            'assesmentskala'=> $request->assesmentskala,   
            'assesmentscore'=> $request->assementvalue
        ]);
        return $updates;
    }
    public function updateTrsAssesmentDetailfiveSingle($request)
    { 
   
        $updates = type_five_trsdetailassesment::where('id', $request->id)->update([
            'assementvalue'=> $request->assementvalue,      
            'transactiondate'=> $request->dateupdatedetail,       
            'assesmentscore'=> $request->assesmentbobotvalue*$request->assementvalue
        ]);
        return $updates;
    }
    public function updateTrsAssesmentDetailfiveSinglePlak($request)
    { 
        $updates = type_five_trsdetailassesment::where('id', $request->id)->update([
            'nilaitindakan_awal'=> $request->nilaitindakan_awal,      
            'nilaitindakan_akhir'=> $request->nilaitindakan_akhir_fix,   
            'nilaisikap_awal'=> $request->nilaisikap_awal,     
            'nilaisikap_akhir'=> $request->nilaisikap_akhir_fix,         
            'assesmentscore'=> $request->nilaitindakan_akhir_fix+$request->nilaisikap_akhir_fix
        ]);
        return $updates;
    }
    public function viewRecapOrtodonsi($request)
    {
        return DB::table("finalassesment_orthodonties")
        ->where('yearid',$request->yearid)
        ->where('semesterid',$request->semesterid)
        ->paginate(10);
    }
    public function viewRecapPedodonsi($request)
    {
        //store procedure, dan table final blm ada
        return null;
    }
    public function viewRecapProstodonsi($request)
    {
        return DB::table("finalassesment_prostodonties")
        ->where('yearid',$request->yearid)
        ->where('semesterid',$request->semesterid)
        ->paginate(10);
    }
    public function viewRecapPeriodonsi($request)
    {
        return DB::table("finalassesment_periodonties")
        ->where('yearid',$request->yearid)
        ->where('semesterid',$request->semesterid)
        ->paginate(10);
    }
    public function viewRecapKonservasi($request)
    {
        return DB::table("finalassesment_konservasis")
        ->where('yearid',$request->yearid)
        ->where('semesterid',$request->semesterid)
        ->paginate(10);
    }
    public function viewRecapRadiologi($request)
    {
        return DB::table("finalassesment_radiologies")
        ->where('yearid',$request->yearid)
        ->where('semesterid',$request->semesterid)
        ->paginate(10);
    }
    public function generateRecapAssesment($request,$procedure)
    { 
        $updates= DB::select('CALL '.$procedure.'(?, ?, ?)', [$request->studentid,$request->semesterid,$request->yearid]);
        return $updates;
    }
    public function lockAssesments($request)
    { 
        $updates = trsassesment::where('id', $request->id)->update([
            'lock'=> '1',      
            'usernamelock'=> $request->userlock,      
            'datelock'=> Carbon::now(),
        ]);
        return $updates;
    }
    public function findEmrByNimStudent($data){
        $query = DB::table('emrperiodonties')
        ->select('emrperiodonties.id','students.id','students.name','students.nim')
        ->join('students','emrperiodonties.npm','=','students.nim')
        ->leftjoin('type_five_trsdetailassesments','type_five_trsdetailassesments.norm','=','emrperiodonties.no_rekammedik')
        ->where('students.id',$data);
        return $query;
    }
}