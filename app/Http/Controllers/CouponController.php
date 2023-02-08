<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Exports\CouponExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Yajra\Datatables\Datatables;
use App\Repositories\Coupon\CouponRepository;

class CouponController extends Controller
{
    protected $couponRepo;

    public function __construct(CouponRepository $couponRepo)
    {
        return $this->couponRepo = $couponRepo;
    }

    public function getDanhsach(Coupon $coupon)
    {
        $lists = $coupon->getList();
        return view('admin.coupon.danhsach', \compact('lists'));
    }

    public function getList(Coupon $coupon)
    {
        $lists = $coupon->getList();

        return DataTables::of($lists)
        ->editColumn('condition_coupon', function ($lists) {
            return $lists->condition_coupon== 1 ? '1-Theo Tiền' : '0-Theo %';
        })
        ->editColumn('number', function ($lists) {
          //  return $lists->condition_coupon== 1 ? number_format($hi->number) vnd->name : '';
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
        ->rawColumns(['condition_coupon', 'customer','status','delete','edit'])
        ->make(true);
    }

    public function getXoa(Request $re, Coupon $coupon)
    {
        $id = $re->id;
        $coupon->getDestroy($id);
        return redirect()->back();
    }
    public function getThem(Coupon $coupon)
    {
        $kt = 0;
        while ($kt == 0) {
            $random = str_random(8);
            $coupon = $coupon->checkRandom($random);
            if ($coupon == false) {
                $kt = 1;
            }
        }
        $coderandom = ['code' => $random];
        return view('admin.coupon.them', compact('coderandom'));
    }
    public function getMarandom(Coupon $coupon)
    {
        $kt = 0;
        while ($kt == 0) {
            $random = str_random(8);
            $coupon = $coupon->checkRandom($random);
            if ($coupon == false) {
                $kt = 1;
            }
        }
        return ($random);

    }
    public function postThem(Request $re, Coupon $coupon)
    {
        $this->validate($re, [
            'name' => 'required|max:100|min:6',
            'time' => 'required',
            'code' => 'required',
            'condition_coupon' => 'required',
            'number' => 'required',
        ]);
        $coupon->saveInfo($re);
        return redirect('admin/coupon/danhsach')->with(['alert-type' => 'success', 'message' => 'Create successfully']);

    }
    public function getSua($id, Coupon $coupon)
    {
        $coupon = $coupon->getDetail($id);
        return view('admin.coupon.sua', compact('coupon'));
    }
    public function postSua(Request $re, Coupon $coupon, $id)
    {
        $this->validate($re, [
            'name' => 'required|max:100|min:6',
            'time' => 'required',
            'condition_coupon' => 'required',
            'number' => 'required',
        ]);
        $coupon->updateInfo($re, $id);
        return redirect('admin/coupon/danhsach')->with(['alert-type' => 'success', 'message' => 'Edit successfully']);

    }
    public function getApplycoupon(Request $re, Coupon $coupon)
    {
        $coupon_code = $re->coupon_code;
        $kiemtra = $coupon->checkCode($coupon_code);
        if ($kiemtra) {
            $soluong = $kiemtra->time;
            $kiemtra->time = $soluong - 1;
            $kiemtra->save();
            $session_coupon = Session::get('coupon');
            if ($session_coupon == true) {
                $cou[] = array(
                    'id_coupon' => $kiemtra->id,
                    'code' => $kiemtra->code,
                    'condition' => $kiemtra->condition_coupon,
                    'number' => $kiemtra->number,
                );
                Session::put('coupon', $cou);
            } else {
                $cou[] = array(
                    'id_coupon' => $kiemtra->id,
                    'code' => $kiemtra->code,
                    'condition' => $kiemtra->condition_coupon,
                    'number' => $kiemtra->number,
                );
                Session::put('coupon', $cou);
            }
            Session::save();
            return redirect()->back()->with('succes_coupon', 'Thêm mã giảm giá thành công');

        } else {
            Session::forget('coupon');
            return redirect()->back()->with('error_coupon', 'Mã Giam Gía Không Đúng Hoặc Hết Hạn');
        }
    }
    public function getXoamagiamgia(Coupon $coupon)
    {
        if (Session::has('coupon')) {
            $data = Session::get('coupon');
            $id = $data[0]['id_coupon'];
            $coupon->xoaMa($id);
            Session::forget('coupon');
            return redirect('shopping_cart')->with('succes_coupon', 'Xóa mã giảm giá thành công');
        }

    }

    public function getExcel()
    {

        // $data[] = [
        //     ['Danh sach ma giam gia'],
        //     ['id', 'name', 'time', 'Type', 'number', 'code', 'status'],
        // ];
        // $coupons = Coupon::all();
        // foreach ($coupons as $coupon) {
        //     $type =  $coupon->condition_coupon == 1 ? 'Theo tien' : 'Theo %';
        //     $data[] = [$coupon->id, $coupon->name,$coupon->time, $type, $coupon->number, $coupon->code, $coupon->status];
        // }
        // $export = new CouponExport($data);
        //return Excel::download(new CouponExport, 'invoices.xlsx');
        return (new CouponExport(2020))->download('invoices.xlsx');
    }

}
