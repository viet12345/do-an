<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;
class CustomerController extends Controller
{
     public function getDanhsach(Customer $customer){
    	$danhsach= $customer->getList();
    	return view('admin.customer.danhsach',compact('danhsach'));
    }

    public function getExcel(Customer $customer){
    	$data[]=['Danh sach khach hang'];
    	$data[]=['STT','Ho Ten','Gioi Tinh','Gmail','So Dien Thoai','Dia Chi'];
    	$cus= $customer->getList();
    	$count=count($cus);
    	for ($i=0; $i <$count ; $i++) {
    		$data[]=[$i+1,$cus[$i]->name,$cus[$i]->gender,$cus[$i]->email,$cus[$i]->phone_number,$cus[$i]->address];
    	}
    	$export = new CustomerExport($data);

    return Excel::download($export, 'customer.xlsx');
    }
}
