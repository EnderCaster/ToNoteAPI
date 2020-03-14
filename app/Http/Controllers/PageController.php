<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'parent' => 'required'
        ], config('validation')['pages']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $pages = Page::query()->where('parent', '=', $request->input('parent'))->where('uid', '=', $request->user()->id)->get();
        return $this->makeReturnArray($pages);
    }
    public function one(Request $request, $uuid)
    {
        $page = Page::where('uuid', '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        if (empty($page)) {
            return $this->makeReturnArray([], 404, $this->lang('names.pages') . $this->lang('msg.not-found') . ',' . $this->lang('msg.retry'));
        }
        return $this->makeReturnArray($page);
    }
    public function save(Request $request, $uuid)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'title' => 'required',
            'content' => 'required'
        ], config('validation')['pages']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $page = Page::where('uuid', '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        $page->fill($request->all());
        $page->save();
        return $this->makeReturnArray($page);
    }
    public function add(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'parent' => 'required',
            'title' => 'required'
        ], config('validation')['pages']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $page = new Page();
        $page->parent = $request->input('parent');
        $page->uuid = strtoupper(Uuid::uuid1()->getHex());
        $page->uid = $request->user()->id;
        $page->title = $request->input('title');
        $page->content = "";
        $page->save();
        return $this->makeReturnArray($page);
    }
    public function delete(Request $request, $uuid)
    {
        $page = Page::where("uuid", '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        if (empty($page)) {
            return $this->makeReturnArray([], 404, $this->lang('names.pages') . $this->lang('msg.not-found') . ',' . $this->lang('msg.retry'));
        }
        $page->delete();
        return $this->makeReturnArray($page);
    }
}
