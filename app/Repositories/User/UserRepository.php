<?php

namespace App\Repositories\User;
use App\Repositories\BaseRopository;
use App\User;

class UserRepository extends BaseRopository
{
    public function getModel()
    {
        return User::class;
    }
}

