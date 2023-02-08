<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('test',function(){
    return view('test');
});
Route::get('/','HomeController@getTrangchu');
Route::get('trangchu','HomeController@getTrangchu')->name('home');
Route::get('theloai/{id}','HomeController@getTheloai');
Route::get('gioithieu','HomeController@getGioithieu');
Route::get('lienhe','HomeController@getLienhe');
Route::get('chitiet/{id}','HomeController@getChitiet');

Route::get('login-facebook','HomeController@login_facebook');
Route::get('callback','HomeController@callback_facebook');


Route::get('login-google','HomeController@login_google');
Route::get('callback-google','HomeController@callback_google');

//comment
Route::get('comment','HomeController@getComment');
Route::get('slide','HomeController@getSlide');
Route::get('timkiem','HomeController@getTimkiem');


Route::get('ajax','HomeController@getAjax');

Route::get('dangky','HomeController@getDangky');
Route::post('dangky','HomeController@postDangky');
Route::get('dangnhap','HomeController@getDangnhap');
Route::post('dangnhap','HomeController@postDangnhap');
Route::get('dangxuat','HomeController@getDangxuat');

Route::get('laylaimatkhau','HomeController@getLaylaimatkhau');
Route::post('laylaimatkhau','HomeController@postLaylaimatkhau');

Route::get('/resetmatkhau','HomeController@getResetmatkhau')->name('reset.matkhau');
Route::post('/resetmatkhau','HomeController@postResetmatkhau')->name('post-reset-matkhau');
//

Route::post('themgiohang','CartController@postThemgiohang');
Route::get('get-qty-product', 'ProductController@getQtyById')->name('product.get.qty');
Route::post('themgiohangchitiet','CartController@postThemgiohangchitiet');
Route::get('shopping_cart','CartController@getShoppingcart');
Route::get('fee_apply','QuanhuyenController@getApplyFee');
Route::post('apply_coupon','CouponController@getApplycoupon');
Route::get('xoamagiamgia','CouponController@getXoamagiamgia');

Route::post('suagiohang','CartController@postUpdatecart');
Route::get('xoagiohang/{rowId}','CartController@getXoagiohang');

Route::post('save-info-order','CartController@saveInfoOrder')->name('save.info.order');
Route::get('thanhtoan','CartController@getThanhtoan')->name('thanhtoan');
Route::post('thanhtoan','CartController@postThanhtoan');
Route::get('camon','CartController@getCamon')->name('thankyou');
# PayPal checkout
Route::get('checkout', 'PaypalController@payWithpaypal')->name('checkout');
# PayPal status callback
Route::get('status', 'PaypalController@getPaymentStatus');
// stripe
Route::get('stripe', 'PaymentController@stripe')->name('stripe');
Route::post('stripe', 'PaymentController@stripePost')->name('stripe.post');
// onepay
Route::get('onepay', 'PaymentController@onepay')->name('onepay');
Route::get('onepay.do', 'PaymentController@onepayDO')->name('onepay.do');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::get('/','DashboardController@index')->name('dashboard.index');
	Route::get('admin-logout','TheloaiController@getLogoutAdmin')->name('admin.logout');
	Route::group(['prefix'=>'theloai'],function(){
        Route::get('danhsach','TheloaiController@getDanhsach');
        Route::get('lists','TheloaiController@getList')->name('theloai.list');
		Route::get('them','TheloaiController@getThem');
		Route::post('them','TheloaiController@postThem');
		Route::get('sua/{id}','TheloaiController@getSua');
		Route::post('sua/{id}','TheloaiController@postSua');
		Route::get('xoa','TheloaiController@getXoa');
	});
	Route::group(['prefix'=>'slide'],function(){
        Route::get('danhsach','SlideController@getDanhsach');
        Route::get('lists','SlideController@getList')->name('slide.list');
		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');
		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');
		Route::get('xoa','SlideController@getXoa');
		Route::get('excel','SlideController@getExcel');
	});
	Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','UserController@getDanhsach');
        Route::get('lists','UserController@getList')->name('user.list');
		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');
		Route::get('xoa','UserController@getXoa');
		Route::get('excel','UserController@getExcel');
		Route::post('chenexcel','UserController@postChenexcel');
	});
	Route::group(['prefix'=>'sanpham'],function(){
        Route::get('danhsach','ProductController@getDanhsach');
        Route::get('lists','ProductController@getList')->name('sanpham.list');
		Route::get('them','ProductController@getThem');
		Route::post('them','ProductController@postThem');
		Route::get('sua/{id}','ProductController@getSua');
		Route::post('sua/{id}','ProductController@postSua');
		Route::get('xoa','ProductController@getXoa');
	});
	Route::group(['prefix'=>'customer'],function(){
		Route::get('danhsach','CustomerController@getDanhsach');
		Route::get('excel','CustomerController@getExcel');
	});
	Route::group(['prefix'=>'bill'],function(){
        Route::get('danhsach','BillController@getDanhsach');
        Route::get('lists','BillController@getList')->name('bill.list');
		Route::get('danhsachchitiet/{id}','BillController@getDanhsachchitiet');
		Route::get('xoa','BillController@getXoa');
		Route::get('giaohang','BillController@getGiaohang');
		Route::get('bogiaohang','BillController@getBogiaohang');
		Route::get('pdf/{id}', 'BillController@getPdf');
		Route::get('qty_pro_order_update','BillController@getQty_pro_order_update');
	});
	Route::group(['prefix'=>'coupon'],function(){
        Route::get('danhsach','CouponController@getDanhsach');
        Route::get('lists','CouponController@getList')->name('coupon.list');
        Route::get('excel','CouponController@getExcel');
		Route::get('them','CouponController@getThem');
		Route::get('marandom','CouponController@getMarandom');
		Route::post('them','CouponController@postThem');
		Route::get('sua/{id}','CouponController@getSua');
		Route::post('sua/{id}','CouponController@postSua');
		Route::get('xoa','CouponController@getXoa');
	});
	Route::group(['prefix'=>'quanhuyen'],function(){
		Route::get('danhsach','QuanhuyenController@getDanhsach');
		Route::get('them','QuanhuyenController@getThem');
		Route::post('them','QuanhuyenController@postThem');
		Route::get('sua/{id}','QuanhuyenController@getSua');
		Route::post('sua/{id}','QuanhuyenController@postSua');
		Route::get('xoa','QuanhuyenController@getXoa');
    });

    Route::group(['prefix'=>'warehouse'],function(){
        Route::get('danhsach','WareHouseController@index')->name('warehouse.index');
        Route::get('data','WareHouseController@datatable')->name('warehouse.data');
		Route::get('them','WareHouseController@add')->name('warehouse.add');
		Route::post('them','WareHouseController@store')->name('warehouse.srote');
		Route::get('sua/{id}','WareHouseController@edit')->name('warehouse.edit');
		Route::post('sua/{id}','WareHouseController@update')->name('warehouse.update');
		Route::get('xoa','WareHouseController@destroy')->name('warehouse.destroy');
    });

    Route::group(['prefix'=>'shipper'],function(){
        Route::get('danhsach','ShipperController@index')->name('shipper.index');
        Route::get('data','ShipperController@datatable')->name('shipper.data');
		Route::get('them','ShipperController@add')->name('shipper.add');
		Route::post('them','ShipperController@store')->name('shipper.srote');
		Route::get('sua/{id}','ShipperController@edit')->name('shipper.edit');
		Route::post('sua/{id}','ShipperController@update')->name('shipper.update');
		Route::get('xoa','ShipperController@destroy')->name('shipper.destroy');
    });
});
