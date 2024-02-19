<?php
namespace App\Repositories\Interfaces;

Interface PatientRepositoryInterface{
    public function findpatients();         
    public function findbyNoregistrasi($id);  
    public function storePatient($request);   

}