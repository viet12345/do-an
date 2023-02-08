<?php

namespace App\Http\Controllers;

use App\BillDetail;
use App\Bills;
use App\Coupon;
use App\Customer;
use App\Products;
use App\Quanhuyen;
use App\User;
use App\Shipper;
use Illuminate\Http\Request;
use PDF;
use Redirect;
use Yajra\Datatables\Datatables;
use App\Repositories\Bill\BillRepository;

class BillController extends Controller
{
    protected $billDetail;
    public function __construct(BillDetail $billDetail)
    {
        $this->billDetail = $billDetail;
        $this->billRepo =  new BillRepository();
    }
    public function getDanhsach()
    {
        return view('admin.bill.danhsach');
    }

    public function getList(Bills $bill)
    {
        $lists = $bill->getListWithUserAndCustommer();

        return DataTables::of($lists)
        ->editColumn('user', function ($lists) {
            return !empty($lists->user) ? $lists->user->full_name : '';
        })
        ->editColumn('customer', function ($lists) {
            return !empty($lists->customer) ? $lists->customer->name : '';
        })
        ->editColumn('shipper', function ($lists) {
            return !empty($lists->shipper) ? $lists->shipper->name : 'Chưa xử lý';
        })
        ->addColumn('status', function ($lists) {
            if($lists->status==0){
                return '<button class="btn btn-primary chuaxuly" data-id_bill="'.$lists->id.'"> Chưa Xử Lý </button>';
            }

            return '<button class="btn btn-success daxuly" data-id_bill="'.$lists->id.'"> Đã Xử Lý </button>';
        })
        ->addColumn('delete', function ($lists) {
            return '<button  class="btn btn-danger" onclick="deleteBill('.$lists->id.')" value="'.$lists->id.'"> <i class="fas fa-trash-alt"></i></button>';
        })
        ->addColumn('edit', function ($lists) {
            return '<a class="btn btn-primary" href="index.php/admin/bill/danhsachchitiet/'.$lists->id.'"><i class="fas fa-eye"></i></a>';
        })
        ->setRowId(function ($lists) {
            return $lists->id;
        })
        ->rawColumns(['user', 'customer','status','shipper','delete','edit'])
        ->make(true);
    }

    public function getXoa(Request $re, Bills $bill)
    {
        $id = $re->id;
        $bill->getDestroy($id);
        return redirect()->back();
    }

    public function getDanhsachchitiet($id, Bills $bill, Customer $customer, User $user, Coupon $coupon, Quanhuyen $quanhuyen, Shipper $shipper)
    {
        $bill =  $bill->getDetail($id);
        $cus = $customer->getDetail($bill->id_customer);
        $user = $user->getDetail($bill->id_user);
        $detail = Bills::where('bills.id', $id)
            ->join('bill_detail', 'bill_detail.id_bill', '=', 'bills.id')
            ->join('products', 'products.id', '=', 'bill_detail.id_product')
            ->get();
        $coupon = $coupon->getDetail($bill->id_coupon);
        $ship = $quanhuyen->getDetail($bill->id_ship);
        if ($bill->id_coupon > 0) {
            if ($coupon->condition_coupon == 0) {
                $tiengiam = $bill->total * $coupon->number / 100;
                $t_data['tiengiam'] = $tiengiam;
            } else {
                $tiengiam = $coupon->number;
                $t_data['tiengiam'] = $tiengiam;
            }
        } else {
            $t_data['tiengiam'] = 0;
        }
        $t_data['diachi'] = $ship->name;
        $t_data['tienship'] = $ship->fee;
        $shippers = $shipper->getList();
        return view('admin.bill.danhsachchitiet', compact('shippers', 'cus', 'detail', 'bill', 'user', 't_data'));
    }
    public function getQty_pro_order_update(Request $re)
    {
        $this->billDetail->updateProductOrder($re);
    }
    public function getGiaohang(Request $re, Bills $bill, Products $product)
    {
        $id = $re->id_bill;
        $bill->updateGiaoHang($id, 1, $re->shipId);
        $qty_pro_sale = $re->qty_pro_sale;
        $id_pro_sale = $re->id_pro_sale;

        foreach ($id_pro_sale as $key_id => $id_pro) {
            $product = $product->getDetail($id_pro) ;
            $product_qty = $product->qty_pro;
            $product_qty_sale = $product->qty_sale;
            foreach ($qty_pro_sale as $key_qty => $qty_pro) {
                if ($key_id == $key_qty) {
                    $product->qty_pro = $product_qty - $qty_pro;
                    $product->qty_sale = $product_qty_sale + $qty_pro;
                    $product->save();
                }
            }
        }
    }
    public function getBogiaohang(Request $re, Bills $bill, Products $product)
    {
        $id = $re->id_bill;
        $bill->updateGiaoHang($id, 0, 0);
        $qty_pro_sale = $re->qty_pro_sale;
        $id_pro_sale = $re->id_pro_sale;
        foreach ($id_pro_sale as $key_id => $id_pro) {
            $product = $product->getDetail($id_pro);
            $product_qty = $product->qty_pro;
            $product_qty_sale = $product->qty_sale;
            foreach ($qty_pro_sale as $key_qty => $qty_pro) {
                if ($key_id == $key_qty) {
                    $product->qty_pro = $product_qty + $qty_pro;
                    $product->qty_sale = $product_qty_sale - $qty_pro;
                    $product->save();
                }
            }
        }
    }
    public function getPdf($id, Bills $bill, Customer $customer, User $user, Coupon $coupon, Quanhuyen $quanhuyen, Shipper $shipper)
    {
        $bill =  $bill->getDetail($id);
        $data['title'] = 'Notes List';
        $data['detail'] = Bills::where('bills.id', $id)
            ->join('bill_detail', 'bill_detail.id_bill', '=', 'bills.id')
            ->join('products', 'products.id', '=', 'bill_detail.id_product')
            ->get();
        $data['cus'] = $customer->getDetail($bill->id_customer);
        $data['user'] = $user->getDetail($bill->id_user);
        $data['bill'] = $bill->getDetail($id);

        $coupon =  $coupon->getDetail($bill->id_coupon);
        $ship =  $quanhuyen->getDetail($bill->id_ship);
        if ($bill->id_coupon > 0) {
            if ($coupon->condition_coupon == 0) {
                $tiengiam = $bill->total * $coupon->number / 100;
                $t_data['tiengiam'] = $tiengiam;
            } else {
                $tiengiam = $coupon->number;
                $t_data['tiengiam'] = $tiengiam;
            }
        } else {
            $t_data['tiengiam'] = 0;
        }

        $t_data['diachi'] = $ship->name;
        $t_data['tienship'] = $ship->fee;
        $data['t_data'] = $t_data;
        $pdf = PDF::loadView('admin.bill.bill_pdf', $data);
        $namefile = "Hoa don" . $id . ".pdf";
        return $pdf->download($namefile);
    }
}
