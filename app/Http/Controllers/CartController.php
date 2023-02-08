<?php

namespace App\Http\Controllers;

use App\BillDetail;
use App\Bills;
use App\Customer;
use App\Products;
use App\Quanhuyen;
use App\TypeProducts;
use Cart;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    //
    public function __construct(Request $re)
    {
        $meta_desc = "ngoc hien";
        $url_canonical = $re->url();
        $meta_keywords = "key";
        $meta_title = "tittle";
        $image_og = "cc";
        $theloai = TypeProducts::all();
        view()->share(['theloai' => $theloai, 'meta_desc' => $meta_desc, 'url_canonical' => $url_canonical,
            'meta_keywords' => $meta_keywords, 'meta_title' => $meta_title, 'image_og' => $image_og]);
    }

    public function postThemgiohang(Request $re, Products $products)
    {
        $qty = 1;
        $size = "M";
        $id = $re->cart_product_id;
        $pro = $products->getDetail($id);
        $price = $pro->unit_price;
        if ($pro->promotion_price != 0) {
            $price = $pro->promotion_price;
        } else {
            $price = $pro->unit_price;
        }
        $cart_info['id'] = $id;
        $cart_info['name'] = $pro->name;
        $cart_info['qty'] = $qty;
        $cart_info['price'] = $price;
        $cart_info['weight'] = $price;
        $cart_info['options']['image'] = $pro->image;

        $cart_info['options']['size'] = $size;
        Cart::add($cart_info);
    }
    public function postThemgiohangchitiet(Request $re, Products $products)
    {
        $soluong = $re->soluong;
        $size = $re->size;
        $id = $re->cart_product_id;
        $pro = $products->getDetail($id);
        $price = $pro->unit_price;
        if ($pro->promotion_price != 0) {
            $price = $pro->promotion_price;
        } else {
            $price = $pro->unit_price;
        }
        $cart_info['id'] = $id;
        $cart_info['name'] = $pro->name;
        $cart_info['qty'] = $soluong;
        $cart_info['price'] = $price;
        $cart_info['weight'] = $price;
        $cart_info['options']['image'] = $pro->image;
        $cart_info['options']['size'] = $size;
        Cart::add($cart_info);
    }
    public function getShoppingcart(Quanhuyen $quanHuyen)
    {
        $quanhuyen = $quanHuyen->getList();
        return view('page.shopping_cart', compact('quanhuyen'));
    }
    public function postUpdatecart(Request $re, Products $product)
    {
        $qty = $product->getQtyById($re->id);
        if($qty >= $re->qty){
            $rowId = $re->rowId;
            $data['qty'] = $re->qty;
            $data['options']['size'] = $re->size;
            $data['options']['image'] = $re->image;

            Cart::update($rowId, $data);
            return redirect('shopping_cart');
        }
        return redirect()->back()->with(['alert-type' => 'warning', 'message' =>'Sản phẩm trong kho không đủ, vui lòng giảm số lượng mua']);
    }
    public function getXoagiohang($rowId)
    {
        Cart::remove($rowId);
        return redirect('shopping_cart');
    }
    public function getThanhtoan()
    {
        if (Session::has('user_id')) {
            return view('page.thanhtoan');
        } else {
            return redirect('dangnhap');
        }

    }

    public function saveInfoOrder(Request $request)
    {
        Session::put('orName',$request->name);
        Session::put('orEmail',$request->email);
        Session::put('orAdress',$request->adress);
        Session::put('orPhone',$request->phone);
        Session::put('orGender',$request->gender);
        Session::put('orNote',$request->note);
    }

    public function postThanhtoan(Request $re, Customer $customer, Bills $bill, BillDetail $billDetail)
    {
        $this->validate($re,
            [
                'name' => 'required|max:150',
                'email' => 'required|email|string|max:150',

                'adress' => 'required|max:150',
                'phone' => 'required|max:20|regex:/^[\d\-\.\s]{10,20}+$/i',

            ], [
                'name.required' => 'Nhập tên người nhận hàng',
                'name.max' => 'Tên không được lớn hơn 150 ký tự',
                'email.required' => 'Nhập email người nhận hàng',
                'email.max' => 'Email không được lớn hơn 150 ký tự',
                'email.email' => 'Định dạng email không hợp lệ',
                'adress.required' => 'Nhập địa chỉ người nhận hàng',
                'adress.max' => 'Địa chỉ không được lớn hơn 150 ký tự',
                'phone.required' => 'Nhập số điện thoại người nhận hàng',
                'phone.regex' =>'Định dạng số điện thoại không hợp lệ',
                'phone.max' => 'Số điện thoại không được lớn hơn 20 ký tự',
            ]);

        $cus = $customer->saveInfo($re);
        $id_customer = $cus->id;
        $bi = $bill->saveInfo($re, $id_customer);
        $content = Cart::content();
        foreach ($content as $key => $value) {
            $billDetail->saveInfo($bi->id, $value);
        }
        Cart::Destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        return redirect('camon');
    }
    public function getCamon()
    {
        if (Session::has('fee_ship')) {
            Session::forget('fee_ship');
        }
        return view('page.camon');
    }
}
