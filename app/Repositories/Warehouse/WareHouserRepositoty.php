<?php

namespace App\Repositories\Warehouse;
use App\WareHouse;
use App\Repositories\BaseRopository;

class WareHouserRepositoty extends BaseRopository
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return WareHouse::class;
    }

    public function getListWithProduct()
    {
        return $this->_model->with('product')->get();
    }
}
