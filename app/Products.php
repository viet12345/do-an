<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Products extends Model
{
    protected $table = "products";
    protected $fillable = ['name', 'id_type', 'key_word', 'description', 'qty_pro', 'qty_sale', 'unit_price', 'promotion_price'
        , 'image', 'unit', 'new'];

    public function product()
    {
        return $this->belongsTo('App\TypeProducts', 'id_type', 'id');
    }

    public function bill_detail()
    {
        return $this->hasMany('App\BillDetail', 'id_product', 'id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment', 'id_product', 'id');

    }

    public function warehouses()
    {
        return $this->hasMany('App\WareHouse', 'product_id');

    }

    public function getDetail($id)
    {
        return $this->find($id);
    }

    public function getByPaginate($num)
    {
        return $this->where('qty_pro','>',0)->orderBy('id', 'desc')->paginate($num);
    }

    public function getNewProduct($num)
    {
        return $this->where('new', 1)->where('qty_pro','>',0)->orderBy('id', 'desc')->paginate($num);
    }

    public function sptheotheloai($id)
    {
        return $this->where('id_type', $id)->where('qty_pro','>',0)->orderBy('id', 'desc')->paginate(8);
    }

    public function splienquan($typeId, $id)
    {
        return $this->where('id_type', $typeId)->where('qty_pro','>',0)->where('id', '<>', $id)->orderBy('id', 'desc')->take(3)->get();
    }

    public function getList()
    {
        return $this->get();
    }

    public function timKiem($re)
    {
        return  $this->where('qty_pro','>',0)->where('name', 'like', '%' . $re->key . '%')->orwhere('unit_price', 'like', '%' . $re->key . '%')->orwhere('promotion_price', 'like', '%' . $re->key . '%')->paginate(8);
    }

    public function timKiemAjax($theloai, $que)
    {
        if ($theloai == "name") {
            return  $this->where('qty_pro','>',0)->where('name', 'like', '%' . $que . '%')->get();
        } else {
            return  $this->where('qty_pro','>',0)->where('unit_price', 'like', '%' . $que . '%')->orwhere('promotion_price', 'like', '%' . $que . '%')->get();
        }
    }

    public function getAll()
    {
        return $this->where('qty_pro','>',0)->get();
    }

    public function getDelete($id)
    {
        return $this->find($id)->delete();
    }

    public function saveInfo($request)
    {
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4) . "_" . $name;
            while (file_exists('public/upload/product/' . $Hinh)) {
                $Hinh = Str::random(4) . "_" . $name;
            }
            $file->move("frontend/image/product/", $name);

        } else {
            $name= "";
        }
        $data = [
            'name' => $request->name,
            'id_type' => $request->theloai,
            'key_word'=> $request->key_word,
            'qty_pro' => $request->qty_pro,
            'description' => $request->mota,
            'unit_price' => $request->unit_price,
            'promotion_price' => $request->promotion_price,
            'unit' => $request->unit,
            'new' => $request->status,
            'image' => $name
        ];
        $this->create($data);
    }

    public function updateInfo($request, $id)
    {
        $data = [
            'name' => $request->name,
            'id_type' => $request->theloai,
            'key_word'=> $request->key_word,
            'qty_pro' => $request->qty_pro,
            'description' => $request->mota,
            'unit_price' => $request->unit_price,
            'promotion_price' => $request->promotion_price,
            'unit' => $request->unit,
            'new' => $request->status,
        ];
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh=Str::random(4)."_".$name;
            while(file_exists('public/upload/product/'.$Hinh)){
            $Hinh=Str::random(4)."_".$name;
            }
            $file->move("frontend/image/product/", $name);
           $data['image'] = $name;
        }
        $this->find($id)->update($data);
    }

    public function addOrSubNumber($id, $old_number, $number,$price, $type)
    {
        $product = $this->find($id);
        if($type == 1){
            $product->increment('qty_pro', $number);
        }
        else{
            $product->increment('qty_pro', $number - $old_number);
        }
        $oldPrice = $product->unit_price;
        if($oldPrice != $price){
            $product->update([
                'unit_price' => $price,
                'promotion_price' => 0
            ]);
        }
    }

    public function getQtyById($id)
    {
        $qty = $this->find($id)->qty_pro;
        return \intval($qty);
    }

    public function getCountProduct()
    {
        return $this->count();
    }
}
