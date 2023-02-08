<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\TypeProducts;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepository $productRepo, CategoryRepository $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function getDanhsach()
    {
        return view('admin.sanpham.danhsach');
    }

    public function getList(Products $product)
    {
        $lists = $product->getAll();
        return DataTables::of($lists)
        ->editColumn('image', function ($lists) {
            return '<img height="40px" src="frontend/image/product/'.$lists->image.'" alt="">';
        })
        ->editColumn('typeProduct', function ($lists) {
            if($lists->product != null){
                return $lists->product->name;
            }
            return "N/A";
        })
        ->editColumn('new', function ($lists) {
            return $lists->new == 1 ? 'Nổi Bật' : 'Không';
        })
        ->addColumn('delete', function ($lists) {
            return '<button onclick="xoaSanpham('.$lists->id.')"  class="btn btn-danger" value="'.$lists->id.'"> <i class="fas fa-trash-alt"></i>  </button>';
        })
        ->addColumn('edit', function ($lists) {
            return '<a class="btn btn-primary" href="index.php/admin/sanpham/sua/'.$lists->id.'"><i class="fas fa-eye"></i></a>';
        })
        ->setRowId(function ($lists) {
            return $lists->id;
        })
        ->rawColumns(['image','typeProduct', 'new','delete','edit'])
        ->make(true);
    }

    public function getXoa(Request $request,Products $product)
    {
        $product->getDelete($request->id);
        return redirect()->back();
    }

    public function getThem(TypeProducts $typeProduct)
    {
        $theloai = $typeProduct->getList();
        return view('admin.sanpham.them', compact('theloai'));
    }

    public function postThem(Request $request, Products $product)
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:6',
            'key_word' => 'required',
            'qty_pro' => 'required',
            'mota' => 'required',
            'unit_price' => 'required',
            'promotion_price' => 'required',
            'Hinh' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);
        $product->saveInfo($request);
        return redirect('admin/sanpham/danhsach')->with(['alert-type' => 'success', 'message' => 'Create successfully']);
    }

    public function getSua($id, Products $product, TypeProducts $typeProduct)
    {
        $sanpham = $product->getDetail($id);
        $theloai = $typeProduct->getList();
        return view('admin.sanpham.sua', compact('sanpham', 'theloai'));
    }

    public function postSua(Request $request, $id, Products $product)
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:6',
            'key_word' => 'required',
            'qty_pro' => 'required',
            'mota' => 'required',
            'unit_price' => 'required',
            'promotion_price' => 'required',
        ]);
        $product->updateInfo($request,$id);
        return redirect('admin/sanpham/danhsach')->with(['alert-type' => 'success', 'message' => 'Edit successfully']);
    }

    public function getQtyById(Request $request, Products $product)
    {
        $qty = $product->getQtyById($request->id);
        return ($qty >= $request->soluong) ? 1 : 0;
    }
}
