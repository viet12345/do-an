<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    protected $table = "warehouses";
    protected $fillable = ['product_id', 'number', 'price', 'pick_up_date', 'manufacture_date', 'expired_date'];

    public function product()
    {
        return $this->belongsTo('App\Products', 'product_id');
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'number' => 'required|numeric',
            'price' => 'required|numeric',
            'pick_up_date' => 'required',
            'manufacture_date' => 'required',
            'expired_date' => 'required',
        ];
    }

    public function getListWithProduct()
    {
        return $this->with('product')->get();
    }
    public function getDetail($id)
    {
        return $this->find($id);
    }

    public function getList()
    {
        return $this->where('status', 1)->get();
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getDelete($id)
    {
        return $this->find($id)->delete();
    }

    public function saveInfo($re)
    {
        $this->create($re->all());
    }

    public function updateInfo($re, $id)
    {
       $this->find($id)->update($re->all());
    }
}
