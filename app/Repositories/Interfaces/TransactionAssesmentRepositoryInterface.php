<?php
namespace App\Repositories\Interfaces;

Interface TransactionAssesmentRepositoryInterface{ 
    public function storeTrsAssesment($data,$uuid); 
    public function verifyTrsAssesment($data,$assesmenttype); 
    public function findassesmentbygrouptype($data,$type);    
    public function findtrsbyid($data); 
    public function updateTrsAssesmentDetailone($key);
    public function storeTrsAssesmentDetailone($key,$uuidheader,$uuiddetail,$date); 
}