<?php
/**
 * Created by PhpStorm.
 * Author: Kokil Thapa <thapa.kokil@gmail.com>
 * Date: 6/12/18
 * Time: 12:25 PM
 */

namespace App\Repositories;

use App\Models\Destination;
use App\Models\User;
use App\Repositories\Repository;

class DestinationRepository extends Repository
{
    public function __construct(Destination $item)
    {
        $this->model = $item;
    }

}
