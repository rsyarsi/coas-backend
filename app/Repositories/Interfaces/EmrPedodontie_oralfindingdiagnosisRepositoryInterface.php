<?php

namespace App\Repositories\Interfaces;

interface EmrPedodontie_oralfindingdiagnosisRepositoryInterface
{
    public function createmedicaldentalhistory($data, $uuid);
    public function createbehaviorrating($data);
    public function findmedicaldentalhistory($data);
    public function updatemedicaldentalhistory($data);
}
