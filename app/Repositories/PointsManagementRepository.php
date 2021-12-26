<?php
/**
 * Created by PhpStorm.
 * Author: Kokil Thapa <thapa.kokil@gmail.com>
 * Date: 6/12/18
 * Time: 12:25 PM
 */

namespace App\Repositories;

use App\Models\PointsManagement;

class PointsManagementRepository extends Repository
{
    public function __construct(PointsManagement $item)
    {
        $this->model = $item;
    }

}
