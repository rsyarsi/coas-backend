<?php
namespace App\Repositories\Interfaces;

Interface SemesterRepositoryInterface{
    public function allSemester();
    public function storeSemester($data,$uuid);
    public function findSemester($id);
    public function updateSemester($data);  
}