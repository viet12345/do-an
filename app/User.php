<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hash;
use App\User;
use Auth;
use Carbon\Carbon;
use Cookie;
use Mail;
use Session;
use Socialite;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'provider', 'phone', 'address', 'idGroup',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bills()
    {
        return $this->hasMany('App\Bills', 'id_user', 'id');

    }
    public function findOrCreateUser($provider, $providerName)
    {

        $account = User::where('provider', $providerName)->where('provider_id', $provider->getId())->first();
        //dd($account);
        if ($account) {
            return $account;
        }
        $kt_gmail = User::where('email', $provider->getEmail())->first();
        if ($kt_gmail) {
            return redirect('/dangnhap')->with('exit_email', 'Email đã tồn tại, vui lòng sử dụng tài khoản email khác');
        }
       // dd($provider->name);
        $user = new User();
        $user->full_name = $provider->name;
        $user->email = $provider->email;
        $user->provider = $providerName;
        $user->provider_id = $provider->id;
        $user->phone = 0;
        $user->address = 0;
        $user->password = 0;
        $user->idGroup = 0;
        $user->save();

        return $user;
    }
    public function createUser($re)
    {
        $user = new User();
        $user->full_name = $re->name;
        $user->email = $re->email;
        $user->phone = $re->phone;
        $user->address = $re->adress;
        $user->password = Hash::make($re->password);
        $user->idGroup = 0;
        $user->save();
    }

    public function getDetail($id)
    {
        return $this->find($id);
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function checkUserByEmail($email, $code)
    {
        return $this->where('email', $email)->where('code', $code)->first();
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
        $User=new User();
    	$User->full_name=$re->name;
    	$User->email=$re->email;
    	$User->password=Hash::make($re->txtPass);
    	$User->phone=$re->phone;
    	$User->address=$re->address;
    	$User->idGroup=$re->idGroup;
    	$User->save();
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
