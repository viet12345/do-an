<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Repositories\User\UserRepository;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function getDanhsach(){
     //   dd($lists = $this->userRepo->getAll());
    	return view('admin.users.danhsach');
    }

    public function getList(User $user)
    {
         $lists = $user->getAll();

        return DataTables::of($lists)
        ->editColumn('idGroup', function ($lists) {
            return $lists->idGroup == 1 ? 'Quản Trị Viên' : 'Người Dùng';
        })
        ->addColumn('delete', function ($lists) {
            return '<button align="center" onclick="deleteUser('.$lists->id.')" class="btn btn-danger" value="'.$lists->id.'"> <i class="fas fa-trash-alt"></i></button>';
        })
        ->setRowId(function ($lists) {
            return $lists->id;
        })
        ->rawColumns(['idGroup','delete'])
        ->make(true);
    }

    public function getXoa(Request $re, User $user){
        $id=$re->id;
        $user->getDelete($id);
    	return redirect()->back();
    }
    public function getThem(){
    	return view('admin.users.them');
    }
    public function postThem(Request $re, User $user){
    	  $this->validate($re,[
            'name'=>'required|max:100|min:6',
            'email'=>'required|email|unique:users,email',
            'address'=>'required',
            'phone'=>'required|min:9',
            'txtPass'=>'required|min:6',
            'txtRePass'=>'required|same:txtPass'

        ]);
        $user->saveInfo($re);
    	return redirect('admin/user/danhsach')->with(['alert-type' => 'success', 'message' =>'Create successfully']);
    }
    public function getExcel(User $user){
        $data[]=array('Danh sach User');
        $data[]=['STT','Ho Ten','Email','Provider','So Dien Thoai','Dia Chi','idGroup'];
        $user=$user->getAll();
        $h=count($user);
        //echo($h);
        for($i=0;$i<$h;$i++){
             $data[]=[$i+1,$user[$i]->full_name,$user[$i]->email,$user[$i]->provider,$user[$i]->phone,$user[$i]->address,$user[$i]->idGroup];
        }

        $export = new UserExport($data);
    return Excel::download($export, 'users.xlsx');
    }
   public function postChenexcel(Request $re){
        if($re->hasFile('excel')){
            $file= $re->file('excel');
             Excel::import(new UsersImport, $file);

            return redirect('/')->with('success', 'All good!');
        }
        else{


            return redirect('/')->with('success', 'All good!');
        }

   }
}
