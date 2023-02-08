<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Shipper extends Model
{
    protected $table = "shippers";
    protected $fillable = ['name', 'image','address','phone','status'];

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

    public function saveInfo($request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4) . "_" . $name;
            while (file_exists('public/upload/shipper/' . $Hinh)) {
                $Hinh = Str::random(4) . "_" . $name;
            }
            $file->move("frontend/image/shipper/", $name);

        } else {
            $name= "";
        }
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address'=> $request->address,
            'image' => $name,
            'status' => $request->status
        ];
        $this->create($data);
    }

    public function updateInfo($request, $id)
    {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address'=> $request->address,
            'status' => $request->status
        ];
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4) . "_" . $name;
            while (file_exists('public/upload/shipper/' . $Hinh)) {
                $Hinh = Str::random(4) . "_" . $name;
            }
            $file->move("frontend/image/shipper/", $name);
            $data ['image']=  $name;
        }
        $this->find($id)->update($data);
    }

}
