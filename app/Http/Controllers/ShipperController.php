<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Shipper;
use App\TypeProducts;
use App\Repositories\Shipper\ShipperRepository;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class ShipperController extends Controller
{
    protected $shipperRepo;

    public function __construct(ShipperRepository $shipperRepo)
    {
        $this->shipperRepo = $shipperRepo;
    }

    public function index()
    {
        return view('admin.shipper.danhsach');
    }

    public function datatable(Shipper $shipper)
    {
         $lists = $shipper->getAll();
        return DataTables::of($lists)
        ->editColumn('image', function ($lists) {
            return '<img height="40px" src="frontend/image/shipper/'.$lists->image.'" alt="">';
        })
        ->editColumn('status', function ($lists) {
            return $lists->status == 1 ? 'Hoạt động' : 'Không';
        })
        ->addColumn('delete', function ($lists) {
            return '<button data-id="'.$lists->id.'"  class="btn btn-danger delete" value="'.$lists->id.'"> <i class="fas fa-trash-alt"></i>  </button>';
        })
        ->addColumn('edit', function ($lists) {
            return '<a class="btn btn-primary" href="index.php/admin/shipper/sua/'.$lists->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
        })
        ->setRowId(function ($lists) {
            return $lists->id;
        })
        ->rawColumns(['image', 'status','delete','edit'])
        ->make(true);
    }

    public function destroy(Request $request, Shipper $shipper)
    {
        $shipper->getDelete($request->id);
    }

    public function add()
    {
        return view('admin.shipper.them');
    }

    public function store(Request $request, Shipper $shipper)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            // 'address' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        $shipper->saveInfo($request);
        return redirect('admin/shipper/danhsach')->with(['alert-type' => 'success', 'message' => 'Create successfully']);
    }

    public function edit($id, Shipper $shipper)
    {
        $shipper = $shipper->getDetail($id);
        return view('admin.shipper.sua', compact('shipper'));
    }

    public function update(Request $request, $id, Shipper $shipper)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'address' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
        ]);
        $shipper->updateInfo($request, $id);
        return redirect('admin/shipper/danhsach')->with(['alert-type' => 'success', 'message' => 'Edit successfully']);
    }
}
