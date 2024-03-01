<?php
namespace App\Repositories\Interfaces;

Interface AbsenceStudentRepositoryInterface{
    public function allAbsenceStudent();    
    public function viewallwithotpaging(); 
    public function storeAbsenceStudent($data,$uuid);
    public function findAbsenceStudent($id);    
    public function updateAbsenceStudentIn($data);    
    public function updateAbsenceStudentOut($data);
    public function absenceperiodemonth($data);
    public function findbydate($data);
}