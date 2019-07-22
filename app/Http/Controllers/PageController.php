<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PageController extends Controller
{
    public function index(Request $request){
//        var_dump($request->input('parent'));
        return Page::all()->where('parent','=',$request->input('parent'));
    }
    public function one($uuid){
        return Page::all()->where('uuid','=',$uuid)->first();
    }
    public function save($uuid){
        $page=Page::where('uuid','=',$uuid)->first();
        $page->content=Input::input('content');
        $page->title=Input::input('title');
        $page->save();
        return $page;
    }
    public function add(){

    }
    public function delete($uuid){}
}
