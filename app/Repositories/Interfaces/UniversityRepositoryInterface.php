<?php
namespace App\Repositories\Interfaces;

Interface UniversityRepositoryInterface{
    public function allUniversity();
    public function storeUniversity($data);
    public function findUniversity($id);     
    public function updateUniversity($data);  
}