<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quanhuyen extends Model
{
    protected $table = "devvn_quanhuyen";
    protected $fillable = ['name', 'type', 'fee'];

    public function getDetail($id)
    {
        return $this->find($id);
    }

    public function getList()
    {
        return $this->all();
    }

    public function getDelete($id)
    {
        return $this->find($id)->delete();
    }

    public function saveInfo($request)
    {
        return $this->create($request->all());
    }

    public function updateInfo($request, $id)
    {
        return $this->find($id)->update($request->all());
    }


}
