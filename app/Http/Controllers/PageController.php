<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request){
//        var_dump($request->input('parent'));
        return Page::all()->where('parent','=',$request->input('parent'));
    }
    public function one($uuid){
        return Page::all()->where('uuid','=',$uuid)->first();
    }
}
