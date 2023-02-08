<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Customer extends Model
{
    protected $table= "customer";
    protected $fillable = ['name', 'gender', 'email', 'address', 'phone_number', 'note'];

    public function bills(){
    	return $this->hasMany('App\Bills','id_customer','id');

    }
    public function getDetail($id)
    {
        return $this->find($id);
    }

    public function saveInfo($request)
    {
        return $this->create([
            'name' =>  $request->name,
            'gender' =>  $request->gender,
            'email' =>  $request->email,
            'address' =>  $request->adress,
            'phone_number' =>  $request->phone,
            'note' =>  $request->note
        ]);
    }

    public function getList()
    {
        return $this->all();
    }

    public function saveInfoPayment()
    {
        $cus = new Customer();
        $cus->name = Session::get('orName');
        $cus->gender = Session::get('orGender');
        $cus->email = Session::get('orEmail');
        $cus->address = Session::get('orAdress');
        $cus->phone_number = Session::get('orPhone');
        $cus->note = Session::get('orNote');
        $cus->save();
        return $cus;
    }
}
