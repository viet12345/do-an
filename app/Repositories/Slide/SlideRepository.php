<?php

namespace App\Repositories\Slide;
use App\Repositories\BaseRopository;
use App\Slide;

class SlideRepository extends  BaseRopository
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Slide::class;
    }
}
