<?php

namespace App\Repositories;

use App\Models\PointsHardLog;

class PointsHardLogRepository extends Repository
{
    public function __construct(PointsHardLog $log)
    {
        $this->model = $log;
    }
}
