<?php

namespace App\Repositories\Category;

use App\Repositories\BaseRopository;
use App\TypeProducts;

class CategoryRepository extends BaseRopository
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return TypeProducts::class;
    }
}
