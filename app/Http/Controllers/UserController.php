<?php

namespace App\Http\Controllers;


use App\User;

class UserController extends Controller
{
    public function login(){
        $url=\request()->getHttpHost().'/oauth/token';
        $parameters=config('passport');
        //use this order to override default value
        $parameters=array_merge($parameters,\request()->only(array_keys($parameters)));
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($parameters));

        return json_decode(curl_exec($curl),true);
    }
    public function newToken(){
        $user=User::find(1);
        return $user->createToken('Primary Token')->accessToken;
    }
}