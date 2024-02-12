<?php

namespace App\Repositories\Interfaces;

interface EmrPedodontiRepositoryInterface
{
    public function createmedicaldentalhistory($data, $uuid);
    public function createbehaviorrating($data);
    public function findmedicaldentalhistory($data);
    public function updatemedicaldentalhistory($data);
}