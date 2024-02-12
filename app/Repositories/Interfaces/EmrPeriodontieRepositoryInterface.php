<?php

namespace App\Repositories\Interfaces;

interface EmrPeriodontieRepositoryInterface
{
    public function createwaktuperawatan($data, $uuid);
    // public function createbehaviorrating($data);
    public function findwaktuperawatan($data);
    public function updatewaktuperawatan($data);
}
