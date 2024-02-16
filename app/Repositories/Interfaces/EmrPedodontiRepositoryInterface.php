<?php

namespace App\Repositories\Interfaces;

interface EmrPedodontiRepositoryInterface
{
    public function createmedicaldentalhistory($data, $uuid);
    public function createbehaviorrating($data);
    public function updatebehaviorrating($data);
    public function deletebehaviorrating($data);
    public function findmedicaldentalhistory($data);
    public function findbehaviorratingbyId($data);
    public function findbehaviorratingAll($data);
    public function updatemedicaldentalhistory($data);

    public function createtreatment($data);
    public function updatetreatment($data);    
    public function validatesupervisor($data); 
    public function deletetreatment($data);
    public function findtreatmentbyId($data);
    public function findtreatmentAll($data);

    public function createtreatmentplan($data);
    public function updatetreatmentplan($data);
    public function deletetreatmentplan($data);
    public function findtreatmentplanbyId($data);
    public function findtreatmentplanAll($data);

}