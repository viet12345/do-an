<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RigisterUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|min:6',
            'email' => 'required|email|unique:users,email',
            'adress' => 'required',
            'phone' => 'required|min:9',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password',
        ];
    }

    
}
