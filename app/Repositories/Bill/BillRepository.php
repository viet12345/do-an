<?php

namespace App\Repositories\Bill;
use App\Repositories\BaseRopository;
use App\Bills;

class BillRepository extends BaseRopository
{
    public function getModel()
    {
        return Bills::class;
    }

    public function getListWithUserAndCustommer()
    {
        return $this->_model->all()->load('user','customer');
    }
}

