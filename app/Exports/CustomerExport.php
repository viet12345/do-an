<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class CustomerExport implements FromArray
{
    
     protected $cus;

    public function __construct(array $cus)
    {
        $this->cus = $cus;
    }

    public function array(): array
    {
        return $this->cus;
    }
    
}
