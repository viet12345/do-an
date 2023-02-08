<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepository;
use App\Repositories\WareHouse\WareHouserRepositoty;
use App\WareHouse;
use App\Products;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class WareHouseController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepository $productRepo, WareHouserRepositoty $warehouseRepo)
    {
        $this->productRepo = $productRepo;
        $this->warehouseRepo = $warehouseRepo;
    }

    public function index()
    {
        return view('admin.warehouse.index');
    }

    public function datatable(WareHouse $wareHouse)
    {
        $lists = $wareHouse->getListWithProduct();
        return DataTables::of($lists)
            ->editColumn('image', function ($lists) {
                return '<img height="40px" src="frontend/image/product/' . $lists->product->image . '" alt="">';
            })
            ->editColumn('name', function ($lists) {
                return $lists->product->name;
            })
            // ->addColumn('delete', function ($lists) {
            //     return '<button  class="btn btn-danger delete" data-id="' . $lists->id . '"> <i class="fas fa-trash-alt"></i>  </button>';
            // })
            ->addColumn('edit', function ($lists) {
                return '<a class="btn btn-primary" href="' . route('warehouse.edit', $lists->id) . '"><i class="fas fa-eye"></i></a>';
            })
            ->setRowId(function ($lists) {
                return $lists->id;
            })
            ->rawColumns(['image', 'delete', 'edit'])
            ->make(true);
    }

    public function destroy(Request $request,WareHouse $wareHouse)
    {
        $wareHouse->getDelete($request->id);
    }

    public function add(Products $product)
    {
        $products = $product->getAll();
        return view('admin.warehouse.add', compact('products'));
    }

    public function store(Request $request, WareHouse $wareHouse, Products $product)
    {
        $this->validate($request, $wareHouse->rules());
        $wareHouse->saveInfo($request);
        $product->addOrSubNumber($request->product_id, 0, $request->number, $request->price, 1);

        return redirect()->route('warehouse.index')->with(['alert-type' => 'success', 'message' => 'Create successfully']);
    }

    public function edit($id, WareHouse $wareHouse, Products $product)
    {

        $item = $wareHouse->getDetail($id);
        $products = $product->getAll();
        return view('admin.warehouse.edit', compact('item', 'products'));
    }

    public function update(Request $request, $id, WareHouse $wareHouse, Products $product)
    {
        $item = $this->warehouseRepo->find($id);
        $this->validate($request, $wareHouse->rules());
        $wareHouse->updateInfo( $request, $id);
        $product->addOrSubNumber($request->product_id, $item->number, $request->number, $request->price, 0);
        return redirect()->route('warehouse.index')->with(['alert-type' => 'success', 'message' => 'Update successfully']);
    }
}
