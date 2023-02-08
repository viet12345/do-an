<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Cart;

class Bills extends Model
{
    protected $table="bills";
    protected $fillable = ['id_customer', 'id_user', 'id_coupon', 'id_ship', 'id_shipper', 'date_order', 'total',
    'payment','note','status'];

    public function billdetail(){
    	return $this->hasMany('App\BillDetail','id_bill','id');
    }
    public function customer(){
    	return $this->belongsTo('App\Customer','id_customer','id');
    }
    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }
    public function shipper(){
    	return $this->belongsTo('App\Shipper','id_shipper','id');
    }

    public function getListWithUserAndCustommer()
    {
        return $this->all()->load('user','customer');
    }

    public function getDestroy($id)
    {
        $bill = $this->find($id);
        $bill->delete();
    }

    public function getDetail($id)
    {
        return $this->find($id);
    }

    public function updateGiaoHang($id, $status, $shipId)
    {
        $this->find($id)->update([
            'status' => $status,
            'id_shipper' => $shipId
        ]);
    }

    public function saveInfo($request, $customerId)
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $id_coupon = $coupon[0]['id_coupon'];
        } else {
            $id_coupon = 0;
        }
        $coupon=Session::get('coupon');
        $tongtien=Cart::subtotal();
        $tongtien =str_replace( ',', '', $tongtien );
        $fee_ship=Session::get('fee_ship');
        if ($coupon) {
            if ($coupon[0]['condition'] == 0) {
                $total = $tongtien - $tongtien * $coupon[0]['number'] / 100 + $fee_ship[0]['fee'];
            } else {
                $total = $tongtien -  $coupon[0]['number'] + $fee_ship[0]['fee'];
            }
            // $total = ($tongtien - $tongtien * $coupon[0]['number'] /100 +$fee_ship[0]['fee']);
        } else {
            $total = ($tongtien +$fee_ship[0]['fee']);
        }
        
        
        $id_ship = $fee_ship[0]['id_fee_ship'];
        $bi = new Bills();
        $bi->id_customer = $customerId;
        $bi->id_user = Session::get('user_id');
        $bi->id_coupon = $id_coupon;
        $bi->id_ship = $id_ship;
        $bi->date_order = date('Y-m-d');
        $bi->total = $total;
        $bi->payment = $request->payment_method;
        $bi->note = $request->note;
        $bi->status = 0;
        $bi->save();
        return $bi;
    }

    public function saveInfoPayment($customerId)
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $id_coupon = $coupon[0]['id_coupon'];
        } else {
            $id_coupon = 0;
        }
        $coupon=Session::get('coupon');
        $tongtien=Cart::subtotal();
        $tongtien =str_replace( ',', '', $tongtien );
        $fee_ship=Session::get('fee_ship');
        if ($coupon) {
            // $total = ($tongtien - $tongtien * $coupon[0]['number'] /100 +$fee_ship[0]['fee']);
            if ($coupon[0]['condition'] == 0) {
                $total = $tongtien - $tongtien * $coupon[0]['number'] / 100 + $fee_ship[0]['fee'];
            } else {
                $total = $tongtien -  $coupon[0]['number'] + $fee_ship[0]['fee'];
            }
        } else {
            $total = ($tongtien + $fee_ship[0]['fee']);
        }
        $id_ship = $fee_ship[0]['id_fee_ship'];
        $bi = new Bills();
        $bi->id_customer = $customerId;
        $bi->id_user = Session::get('user_id');
        $bi->id_coupon = $id_coupon;
        $bi->id_ship = $id_ship;
        $bi->date_order = date('Y-m-d');
        $bi->total = $total;
        $bi->payment = 'Payment';
        $bi->note =  Session::get('orNote');
        $bi->status = 0;
        $bi->save();
        return $bi;
    }



    public function getCountByWhereMonth($month)
    {
        return $this->whereMonth('created_at',$month)->where('status', 1)->latest()->count();
    }

    public function getCountByPaymentWhereMonth($payment, $month)
    {
        return $this->whereMonth('created_at',$month)->where('payment', $payment)->where('status', 1)->latest()->count();
    }


}
