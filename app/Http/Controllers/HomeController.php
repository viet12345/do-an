<?php

namespace App\Http\Controllers;

use App\Http\Requests\RigisterUser;
use App\Products;
use App\Slide;
use App\TypeProducts;
use App\User;
use Auth;
use Carbon\Carbon;
use Cookie;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Session;
use Socialite;

class HomeController extends Controller
{
    protected $user;

    public function __construct(Request $re, User $user)
    {
        $this->user = $user;
        $meta_desc = "ngoc hien";
        $url_canonical = $re->url();
        $meta_keywords = "key";
        $meta_title = "tittle";
        $image_og = "cc";
        $theloai = TypeProducts::all();
        view()->share(['theloai' => $theloai, 'meta_desc' => $meta_desc, 'url_canonical' => $url_canonical,
            'meta_keywords' => $meta_keywords, 'meta_title' => $meta_title, 'image_og' => $image_og]);
    }
    public function getTrangchuajax(Slide $slide, Products $products)
    {
        $slide = $slide->getImaPagi(3);
        $spmoi = $products->getByPaginate(8);
        $spnoibat = $products->getNewProduct(8);
        return view('page.giohangajax', compact('spmoi', 'spnoibat', 'slide'));
    }
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $user = $this->user->findOrCreateUser($provider, 'facebook');
      // dd("cin chao");
        Session::put('user_name', $user->full_name);
        Session::put('user_id', $user->id);
        return redirect('/trangchu');
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        $provider = Socialite::driver('google')->user();
        $user = $this->user->findOrCreateUser($provider, 'google');
       Session::put('user_name', $user->full_name);
        Session::put('user_id', $user->id);
       return redirect('/trangchu');

    }

    public function getTrangchu(Slide $slide, Products $products)
    {

        $slide = $slide->getImaPagi(3);
        $spmoi = $products->getByPaginate(8);
        $spnoibat = $products->getNewProduct(8);
        return view('page.trangchu', compact('spmoi', 'spnoibat', 'slide'));

    }
    public function getSlide()
    {
        return view('page.slide');
    }
    public function getTheloai(Request $re, $id, TypeProducts $TypeProducts, Products $products)
    {
        $meta_theloai = $TypeProducts->getDetail($id);
        $meta_desc = $meta_theloai->description;
        $url_canonical = $re->url();
        $meta_keywords = $meta_theloai->key_word;
        $meta_title = $meta_theloai->name;
        $image_og = $meta_theloai->image;

        $sptheotheloai =$products->sptheotheloai($id);
        $spnoibat =$products->getNewProduct(8);
        return view('page.theloai', compact('sptheotheloai', 'spnoibat', 'meta_desc', 'url_canonical', 'meta_keywords', 'meta_title', 'image_og'));
    }
    public function getChitiet(Request $re, $id, Products $product)
    {
        $chitiet = $product->getDetail($id);
        $meta_desc = $chitiet->description;
        $url_canonical = $re->url();
        $meta_keywords = $chitiet->key_word;
        $meta_title = $chitiet->name;
        $image_og = $chitiet->image;
        $splienquan =$product->splienquan($chitiet->id_type, $chitiet->id);
        $spmoi = $product->getByPaginate(4);
        $spnoibat = $product->getNewProduct(4);
        return view('page.chitiet', compact('chitiet', 'splienquan', 'spnoibat', 'spmoi', 'meta_desc', 'url_canonical', 'meta_keywords', 'meta_title', 'image_og'));
    }

    public function getTimkiem(Request $re, TypeProducts $TypeProduct, Products $product)
    {
        $theloai = $TypeProduct->getList();
        $sanpham = $product->getList();
        $timkiem = $product->timKiem($re);
        $spnoibat = $product->getNewProduct(8);
        return view('page.timkiem', compact('timkiem', 'spnoibat', 'theloai', 'sanpham'));
    }

    public function getAjax(Request $re, Products $product)
    {
        $query = $re->tukhoa;
        $theloai = $re->theloai;
        $timkiem = $product->timKiemAjax($theloai, $query );
        return view('page.ajax', compact('timkiem'));
    }
    public function getGioithieu()
    {
        return view('page/gioithieu');
    }
    public function getLienhe()
    {
        return view('page.lienhe');
    }
    public function getDangky()
    {
        return view('page.dangky');
    }
    public function postDangky(RigisterUser $re)
    {
        $this->user->createUser($re);
        return redirect()->back()->with('thongbaodk', "Đăng ký thành công");
    }
    public function getDangnhap()
    {
        return view('page.dangnhap');
    }
    public function postDangnhap(Request $re)
    {
        $this->validate($re,
            [
                'email' => 'required|email',
                'password' => 'required',
            ]);
        $hi = array('email' => $re->email, 'password' => $re->password);
        if (Auth::attempt($hi)) {
            $name = Auth::user()->full_name;
            $id = Auth::user()->id;
            Session::put('user_name', $name);
            Session::put('user_id', $id);
            if ((Auth::user()->idGroup) > 0) {
                Cookie::queue('admin_name', $name, 60 * 24 * 30); //cookie ton tai trong 30 ngay
                Cookie::queue('admin_id', $id, 60 * 24 * 30); //cookie ton tai trong 30 ngay
                Cookie::queue('admin_email', $re->email, 60 * 24 * 30); //cookie ton tai trong 30 ngay
            }

            return redirect()->back()->with('thongbaodn', "Đăng nhập thành công");
        }
        return redirect()->back()->with('error', 'Đăng nhập thất bại');

    }
    public function getLaylaimatkhau()
    {
        return view('page.quenmatkhau');
    }
    public function postLaylaimatkhau(Request $re, User $user)
    {
        $this->validate($re,
            [
                'email' => 'required|email',
            ]);
        $mail = $re->email;
        $kt_gmail = $user->getUserByEmail($mail);
        if (!$kt_gmail) {
            return redirect()->back()->with('loi_email', 'Email ko tồn tại');
        } else {
            $code = bcrypt(md5(time() . $mail));
            $kt_gmail->code = $code;
            $kt_gmail->time_code = Carbon::now();
            $kt_gmail->save();
            $r = route('reset.matkhau', ['code' => $code, 'mail' => $mail]);
            $data = ['route' => $r,

            ];
            Mail::send('page.email', $data, function ($message) use ($mail) {
                $message->to($mail, 'Lấy lại mật khẩu')->subject('Lấy lại mật khẩu');
            });
            return redirect()->back()->with('success', 'Link lấy lại mật khẩu đã được gửi vào email của bạn');
        }
    }
    public function getResetmatkhau(Request $re, User $user)
    {
        $code = $re->code;
        $mail = $re->mail;
        $check = $user->checkUserByEmail($mail, $code);
        if (!$check) {
            return redirect()->back()->with('danger', 'Link lấy lại mật khẩu không đúng, vui lòng kiểm tra lại!');
        } else {
            $data = ['code' => $code, 'mail' => $mail];
            return view('page.resetmatkhau', compact('data'));
        }
    }
    public function postResetmatkhau(Request $re, User $user)
    {
        $code = $re->code;
        $mail = $re->mail;
        $check = $user->checkUserByEmail($mail, $code);
        if (!$check) {
            return redirect()->back()->with('danger', 'Link lấy lại mật khẩu không đúng, vui lòng kiểm tra lại!');
        } else {
            $this->validate($re, [
                'pass' => 'required|min:6',
                'repassword' => 'required|same:pass',
            ]);
            $check->password = Hash::make($re->pass);
            $check->save();
            return redirect()->back()->with('success', 'Lấy lại mật khẩu thành công!');
        }
    }
    public function getDangxuat()
    {
        Auth::logout();
        Session::put('exit_email', null);
        Session::put('user_name', null);
        Session::put('user_id', null);
        return redirect()->back();
    }

}
