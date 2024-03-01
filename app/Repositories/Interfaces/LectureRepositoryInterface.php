<?php
namespace App\Repositories\Interfaces;

Interface LectureRepositoryInterface{
    public function allLecture();    
    public function viewallwithotpaging(); 
    public function storeLecture($data,$uuid);
    public function findLecture($id);  
    public function findLecturebyNIM($nim);
    public function updateLecture($data);  
}