<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'full_name'  => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make('123456'),
            'provider'    => $row['provider'],
            'phone'    => $row['phone'],
            'address'    => $row['address'],
            'idGroup'    => '0',
        ]);
    }
}
