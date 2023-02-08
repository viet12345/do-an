<?php

namespace App\Http\Controllers;

use App\Exports\SlideExport;
use App\Repositories\Slide\SlideRepository;
use App\Slide;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class SlideController extends Controller
{
    protected $slideRepo;

    public function __construct(SlideRepository $slideRepo)
    {
        $this->slideRepo = $slideRepo;
    }

    public function getDanhsach(Slide $slide)
    {
        $danhsach = $slide->getAll();
        return view('admin.slide.danhsach', compact('danhsach'));
    }

    public function getList(Slide $slide)
    {
         $lists = $slide->getAll();
        return DataTables::of($lists)
        ->editColumn('image', function ($lists) {
            return '<img height="140px" src="frontend/image/slide/'.$lists->image.'" alt="">';
        })
        ->editColumn('status', function ($lists) {
            return $lists->status == 1 ? 'Hiện' : 'Ẩn';
        })
        ->addColumn('delete', function ($lists) {
            return ' <button onclick="xoaSlide('.$lists->id.')" class="btn btn-danger" value="'.$lists->id.'"> <i class="fas fa-trash-alt"></i> </button>';
        })
        ->addColumn('edit', function ($lists) {
            return '<a class="btn btn-primary" href="index.php/admin/slide/sua/'.$lists->id.'"><i class="fas fa-eye"></i></a>';
        })
        ->rawColumns(['image', 'status','delete','edit'])
        ->make(true);
    }

    public function getXoa(Request $request, Slide $slide)
    {
        $slide->getDelete($request->id);
        return redirect()->back();
    }

    public function getThem()
    {
        return view('admin.slide.them');
    }

    public function postThem(Request $re, Slide $slide)
    {
        $this->validate($re, [
            'link' => 'required|max:100|min:6',
            'Hinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        $slide->saveInfo($re);
        return redirect('admin/slide/danhsach')->with(['alert-type' => 'success', 'message' => 'Create successfully']);

    }

    public function getSua($id, Slide $slide)
    {
        $slide =  $slide->getDetail($id);
        return view('admin.slide.sua', compact('slide'));
    }

    public function postSua(Request $request, $id, Slide $slide)
    {
        $this->validate($request, [
            'link' => 'required|max:100|min:6',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        $slide->updateInfo($request, $id);
        return redirect('admin/slide/danhsach')->with(['alert-type' => 'success', 'message' => 'Edit successfully']);

    }

    public function getExcel()
    {
        $slide = DB::table('slide')->get()->toArray();
        $data[] = ['bang tong hop slide cua ngoc hien'];
        $data[] = array('id', 'link', 'image', 'status');
        foreach ($slide as $sl) {
            $data[] = array(
                $sl->id,
                $sl->link,
                $sl->image,
                $sl->status,
            );
        }
        $export = new SlideExport($data);
        return Excel::download($export, 'invoices.xlsx');

    }

}
