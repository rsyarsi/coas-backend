<?php
namespace App\Repositories\Interfaces;

Interface HospitalRepositoryInterface{
    public function allHospital();    
    public function viewallwithotpaging();
    public function storeHospital($data,$uuid);
    public function findHospital($id);     
    public function updateHospital($data);  
}