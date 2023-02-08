<?php
namespace App\Repositories\District;
use App\Quanhuyen;
use App\Repositories\BaseRopository;

class  DistrictRepository extends BaseRopository
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Quanhuyen::class;
    }
}
