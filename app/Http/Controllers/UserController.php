<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



use App\User;

class UserController extends Controller
{
    public function login()
    {
        $url = env('APP_URL') . '/oauth/token';
        $parameters = config('passport');
        //use this order to override default value
        $parameters = array_merge($parameters, \request()->only(array_keys($parameters)));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));

        $auth_result = curl_exec($curl);
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        return $this->makeReturnArray(json_decode($auth_result, true), $status_code);
    }
    public function register(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'username' => 'required|alpha_dash|between:8,50|unique:users,name',
            'password' => 'required|between:8,40|confirmed',
            'password_confirmation' => 'required|between:8,40'
        ], config('validation')['users']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $user_params = ['name' => $inputs['username'], 'password' => Hash::make($inputs['password'])];
        $user = new User();
        $user->fill($user_params);
        $user->save();
        return $this->makeReturnArray([]);
    }
    public function logout()
    {
        //TODO 看看有没有删除token的API
        return $this->makeReturnArray([]);
    }
}
