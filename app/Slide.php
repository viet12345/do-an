<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    //
     protected $table="slide";

     protected $fillable = ['link','image' ,'status'];

     public function getImaPagi($paginate)
     {
         return $this->orderBy('id', 'desc')->paginate($paginate);
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
    if ($re->hasFile('Hinh')) {
        $file = $re->file('Hinh');
        $name = $file->getClientOriginalName();
        $file->move("frontend/image/slide/", $name);
    } else {
        $name = "";
    }
    $data = [
        'link' => $re->link,
        'image' => $name,
        'status' => $re->status,
    ];
    $this->create($data);
    }

     public function updateInfo($request, $id)
     {
        $data = [
            'link' => $request->link,
            'status' => $request->status,
        ];
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $file->move("frontend/image/slide/", $name);
            $data['image'] = $name;
        }
        $this->find($id)->update($data);
     }

    public function getCount()
    {
        return $this->where('status', 1)->count();
    }
}
