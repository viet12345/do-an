<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quanhuyen;
use Session;
use App\Repositories\District\DistrictRepository;

class QuanhuyenController extends Controller
{
    protected $districtRepo;

    public function __construct(DistrictRepository $districtRepo)
    {
        $this->districtRepo = $districtRepo;
    }

    public function getDanhsach(Quanhuyen $quanhuyen)
    {
        $danhsach = $quanhuyen->getList();
        return view('admin.quanhuyen.danhsach', compact('danhsach'));
    }

    public function getXoa(Request $request,Quanhuyen $quanhuyen )
    {
        $quanhuyen->getDelete($request->id);
        return redirect()->back();
    }

    public function getThem()
    {
        return view('admin.quanhuyen.them');
    }

    public function postThem(Request $request,Quanhuyen $quanhuyen)
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:6',
            'type' => 'required',
            'fee' => 'required',
        ]);
        $quanhuyen->saveInfo($request);
        return redirect('admin/quanhuyen/danhsach')->with(['alert-type' => 'success', 'message' => 'Create successfully']);
    }

    public function getSua($id, Quanhuyen $quanhuyen)
    {
        $quanhuyen = $quanhuyen->getDetail($id);
        return view('admin.quanhuyen.sua', compact('quanhuyen'));
    }

    public function postSua(Request $request, $id, Quanhuyen $quanhuyen)
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:6',
            'type' => 'required',
            'fee' => 'required',
        ]);
        $quanhuyen->updateInfo($request, $id);
        return redirect('admin/quanhuyen/danhsach')->with(['alert-type' => 'success', 'message' => 'Edit successfully']);
    }

    public function getApplyFee(Request $request, Quanhuyen $quanhuyen)
    {
        $idFeeShip = $request->id_fee_ship;
        $data = $quanhuyen->getDetail($idFeeShip);
        $feeShip[] = array(
            'id_fee_ship' => $idFeeShip,
            'name' => $data->name,
            'fee' => $data->fee
        );
        Session::put('fee_ship', $feeShip);
    }
}
