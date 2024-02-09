<?php
namespace App\Repositories\Interfaces;

Interface LectureRepositoryInterface{
    public function allLecture();
    public function storeLecture($data,$uuid);
    public function findLecture($id);     
    public function updateLecture($data);  
}