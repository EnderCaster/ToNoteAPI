<?php

namespace App\Http\Controllers;

use App\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class NotebookController extends Controller
{
    public function index(Request $request)
    {
        $notebooks = Notebook::query()->where('uid', '=', $request->user()->id)->get();
        return $this->makeReturnArray($notebooks);
    }

    public function add(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'name' => 'required',
        ], config('validation')['notebooks']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $notebook = new Notebook();
        $notebook->uuid = strtoupper(Uuid::uuid1()->getHex());
        $notebook->name = Input::input('name');
        $notebook->uid = $request->user()->id;
        $notebook->save();
        return $this->makeReturnArray($notebook);
    }

    public function delete(Request $request, $uuid)
    {
        $notebook = Notebook::where('uuid', '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        if (empty($notebook)) {
            return $this->makeReturnArray([], 404, $this->lang('names.notebooks') . $this->lang('msg.not-found') . ',' . $this->lang('msg.retry'));
        }
        $notebook->delete();
        return $this->makeReturnArray($notebook);
    }

    public function save(Request $request, $uuid)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'name' => 'required',
        ], config('validation')['users']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $notebook = Notebook::where('uuid', '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        $notebook->name = $request->input('name');
        $notebook->save();
        return $this->makeReturnArray($notebook);
    }
}
