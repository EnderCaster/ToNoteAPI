<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class PageController extends Controller
{
    public function index(Request $request){
        return Page::all()->where('parent','=',$request->input('parent'));
    }
    public function one($uuid){
        return Page::where('uuid','=',$uuid)->first();
    }
    public function save($uuid){
        $page=Page::where('uuid','=',$uuid)->first();
        $page->content=Input::input('content');
        $page->title=Input::input('title');
        $page->save();
        return $page;
    }
    public function add(){
        $page=new Page();
        $page->parent=Input::input('parent');
        $page->uuid=strtoupper(Uuid::uuid1()->getHex());
        //TODO 获取当前用户id
        $page->uid=0;
        $page->title=Input::input('title');
        $page->content="";
        $page->save();
        return $page;
    }
    public function delete($uuid){
        $page=Page::where("uuid",'=',$uuid)->first();
        $page->delete();
        return $page;
    }
}
