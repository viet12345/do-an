<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupon";
    protected $fillable = ['name', 'time', 'condition_coupon', 'number', 'code', 'status'];

    public function getDetail($id)
    {
        return $this->find($id);
    }

    public function getList()
    {
        return $this->all();
    }

    public function getDestroy($id)
    {
        $this->find($id)->delete();
    }

    public function checkRandom($random)
    {
        return Coupon::where('code', $random)->where('status', 1)->first();
    }

    public function saveInfo($request)
    {
        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->time = $request->time;
        $coupon->code = $request->code;
        $coupon->condition_coupon = $request->condition_coupon;
        $coupon->number = $request->number;
        $coupon->status = $request->status;
        $coupon->save();
    }

    public function updateInfo($request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->name = $request->name;
        $coupon->time = $request->time;
        $coupon->condition_coupon = $request->condition_coupon;
        $coupon->number = $request->number;
        $coupon->status = $request->status;
        $coupon->save();
    }

    public function checkCode($coupon_code)
    {
        return Coupon::where('code', $coupon_code)->where('status', 1)->first();
    }

    public function xoaMa($id)
    {
        $cou = Coupon::find($id);
        $soluong = $cou->time;
        $cou->time = $soluong + 1;
        $cou->save();
    }
}
