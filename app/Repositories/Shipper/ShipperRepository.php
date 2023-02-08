<?php

namespace App\Repositories\Shipper;

use App\Shipper;
use App\Repositories\BaseRopository;

class ShipperRepository extends BaseRopository
{
    public function getModel()
    {
        return Shipper::class;
    }
}
