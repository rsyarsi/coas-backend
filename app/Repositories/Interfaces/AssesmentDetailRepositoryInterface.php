<?php
namespace App\Repositories\Interfaces;

Interface AssesmentDetailRepositoryInterface{
    public function allAssesmentDetail();
    public function storeAssesmentDetail($data);
    public function findAssesmentDetail($id);    
    public function findAssesmentbyGroup($id); 
    public function updateAssesmentDetail($data);  
}