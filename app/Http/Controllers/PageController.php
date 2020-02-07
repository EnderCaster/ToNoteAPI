<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::query()->where('parent', '=', $request->input('parent'))->where('uid', '=', \request()->user()->id)->get();
        return $this->makeReturnArray($pages);
    }
    public function one($uuid)
    {
        return Page::where('uuid', '=', $uuid)->where('uid', '=', \request()->user()->id)->first();
    }
    public function save($uuid)
    {
        $page = Page::where('uuid', '=', $uuid)->where('uid', '=', \request()->user()->id)->first();
        $page->content = Input::input('content');
        $page->title = Input::input('title');
        $page->save();
        return $this->makeReturnArray($page);
    }
    public function add()
    {
        $page = new Page();
        $page->parent = Input::input('parent');
        $page->uuid = strtoupper(Uuid::uuid1()->getHex());
        $page->uid = \request()->user()->id;
        $page->title = Input::input('title');
        $page->content = "";
        $page->save();
        return $this->makeReturnArray($page);
    }
    public function delete($uuid)
    {
        $page = Page::where("uuid", '=', $uuid)->where('uid', '=', \request()->user()->id)->first();
        $page->delete();
        return $this->makeReturnArray($page);
    }
}
