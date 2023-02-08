<?php

namespace App\Repositories\Coupon;
use App\Repositories\BaseRopository;
use App\Coupon;


class CouponRepository extends BaseRopository
{
    public function getModel()
    {
        return Coupon::class;
    }
}