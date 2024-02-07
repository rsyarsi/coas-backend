<?php
namespace App\Repositories\Interfaces;

Interface SemesterRepositoryInterface{
    public function allSemester();
    public function storeSemester($data);
    public function findSemester($id);
    public function updateSemester($data);  
}