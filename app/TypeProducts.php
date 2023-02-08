<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class TypeProducts extends Model
{
    protected $table="type_products";
    public function product(){
    	return $this->hasMany('App\Products','id_type','id');
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
        $theloai=new TypeProducts();
    	$theloai->name= $re->name;
        $theloai->key_word=$re->key_word;
    	$theloai->description =$re->mota;
    	if($re->hasFile('Hinh')){
    		$file= $re->file('Hinh');
    		$name= $file->getClientOriginalName();
    		$file->move("frontend/image/product/",$name);
    		$theloai->image=$name;
    	}
    	else{
    		$theloai->image="";
    	}
    	$theloai->status=$re->status;
    	$theloai->save();
    }

    public function updateInfo($re, $id)
    {
        $theloai=TypeProducts::find($id);
    	$theloai->name= $re->name;
        $theloai->key_word=$re->key_word;
    	$theloai->description =$re->mota;
        $theloai->status=$re->status;
        if($re->hasFile('Hinh')){
    		$file= $re->file('Hinh');
    		$name= $file->getClientOriginalName();
    		$file->move("frontend/image/product/",$name);
    		$theloai->image=$name;
    	}
    	$theloai->save();
    }

    public function getCount()
    {
        return $this->where('status', 1)->count();
    }
}
