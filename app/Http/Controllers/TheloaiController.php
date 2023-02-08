<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeProducts;
use Cookie;
use Yajra\Datatables\Datatables;
use DB;

class TheloaiController extends Controller
{
    //
    public function getDanhsach(TypeProducts $typeProducts){
    	$danhsach= $typeProducts->getAll();
    	return view('admin.theloai.danhsach',compact('danhsach'));
    }
    public function getList(TypeProducts $typeProducts){
        $danhsach= $typeProducts->getAll();
        return Datatables::of($danhsach)
        ->editColumn('image', function ($danhsach) {
            return '<img height="140px" src="frontend/image/product/'.$danhsach->image.'" alt="">';
        })
        ->editColumn('status', function ($danhsach) {
            return $danhsach->status==1 ? 'Nổi Bật' : 'Không';
        })
        ->addColumn('delete', function ($danhsach) {
            return ' <button onclick="xoaSanpham('.$danhsach->id.')"  class="btn btn-danger" value="{{$hi->id}}"> <i class="fas fa-trash-alt"></i>  </button>';
        })
        ->addColumn('edit', function ($danhsach) {
            return '<a class="btn btn-primary" href="index.php/admin/theloai/sua/'.$danhsach->id.'"><i class="fas fa-eye"></i></a>';
        })
        ->setRowId(function ($danhsach) {
            return $danhsach->id;
        })
        ->rawColumns(['image','delete','edit'])
        ->make(true);
    }
    public function getXoa(Request $re, TypeProducts $typeProducts){
        $id=$re->id;
        $typeProducts->getDelete($id);
    }
    public function getThem(){
    	return view('admin.theloai.them');
    }
    public function postThem(Request $re, TypeProducts $typeProducts){
        $this->validate($re,[
            'name'=>'required|max:100|min:6',
            'key_word'=>'required',
            'mota'=>'required',
            'Hinh'=>'required',


        ]);
        $typeProducts->saveInfo($re);
        return redirect('admin/theloai/danhsach')->with(['alert-type' => 'success', 'message' =>'Create successfully']);

    }
    public function getSua($id, TypeProducts $typeProducts){
    	$theloai    =   $typeProducts->getDetail($id);
    	return view('admin.theloai.sua',compact('theloai'));
    }
    public function postSua(Request $re,$id, TypeProducts $typeProducts){
         $this->validate($re,[
            'name'=>'required|max:100|min:6',
            'key_word'=>'required',
            'mota'=>'required',

        ]);
        $typeProducts->updateInfo($re,$id);

        return redirect('admin/theloai/danhsach')->with(['alert-type' => 'success', 'message' =>'Edit successfully']);

    }
    public function getLogoutAdmin(){
        Cookie::queue("admin_name", "",0.01);
        Cookie::queue("admin_id", "", 0.01);
        return redirect('dangnhap');
    }
}
