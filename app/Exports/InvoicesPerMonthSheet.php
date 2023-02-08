<?php

namespace App\Exports;

use App\Coupon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;

class InvoicesPerMonthSheet implements FromQuery, WithTitle
{
    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    /**
     * @return Builder
     */
    public function query()
    {
        $data [] = ['danh sach coupn'];
        $data [] = ['id','name','code'];
        $data [] = Coupon
        ::query()
        ->select(['id','name','code'])
        ->whereYear('created_at', $this->year)
        ->whereMonth('created_at', $this->month)->get();
        return $data;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month ' . $this->month;
    }
}
