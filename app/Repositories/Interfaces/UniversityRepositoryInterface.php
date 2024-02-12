<?php
namespace App\Repositories\Interfaces;

Interface UniversityRepositoryInterface{
    public function allUniversity();    
    public function viewallwithotpaging(); 
    public function storeUniversity($data,$uuid);
    public function findUniversity($id);     
    public function updateUniversity($data);  
}