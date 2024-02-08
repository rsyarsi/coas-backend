<?php
namespace App\Repositories\Interfaces;

Interface HospitalRepositoryInterface{
    public function allHospital();
    public function storeHospital($data);
    public function findHospital($id);     
    public function updateHospital($data);  
}