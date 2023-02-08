<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Products;
use App\Slide;
use App\Bills;
use App\TypeProducts;

class DashboardController extends Controller
{
    public function index(Products $products, Slide $slide, TypeProducts $typeProducts, Bills $bills)
    {
        $products = $products->getCountProduct();
        $slide = $slide->getCount();
        $typeProducts = $typeProducts->getCount();


        $arrSeriesBills = [];
        $arrSeriesNames = [];
        for($i = 5; $i >= 0; $i--){
            $currentDateTime = Carbon::parse(Carbon::now()->toDateString())->format('Y-m');
            $newDateTime = Carbon::parse($currentDateTime)->subMonths($i)->month;
            $arrBill[] = $bills->getCountByWhereMonth(intval($newDateTime));
            $arBillPayment[] = $bills->getCountByPaymentWhereMonth('Payment', intval($newDateTime));
            $arrBillCOD[] = $bills->getCountByPaymentWhereMonth('COD', intval($newDateTime));
            $arrSeriesNames[] = intval($newDateTime);
        }
        $arrSeriesBills[] = [
            'name' => 'Tổng Thanh Toán',
            'type' =>'line',
            'areaStyle' => '{}',
            'data' => $arrBill,
        ];
        $arrSeriesBills[] = [
            'name' => 'Thanh Toán Online',
            'type' =>'line',
            'areaStyle' => '{}',
            'data' => $arBillPayment,
        ];
        $arrSeriesBills[] = [
            'name' => 'Thanh Toán Khi Nhận Hàng',
            'type' =>'line',
            'areaStyle' => '{}',
            'data' => $arrBillCOD,
        ];
        // dd($arrSeriesUsers);

        return view('admin.dashboard.index', [
            'products' => $products,
            'slide' => $slide,
            'typeProducts' => $typeProducts,
            'arrSeriesBills' => $arrSeriesBills,
            'arrSeriesNames' => $arrSeriesNames
        ]);
    }
}
