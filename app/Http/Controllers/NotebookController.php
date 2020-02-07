<?php

namespace App\Http\Controllers;

use App\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class NotebookController extends Controller
{
    public function index(Request $request)
    {
        $notebooks = Notebook::query()->where('uid', '=', $request->user()->id)->get();
        return $this->makeReturnArray($notebooks);
    }

    public function add(Request $request)
    {
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
        $notebook->delete();
        return $this->makeReturnArray($notebook);
    }

    public function save(Request $request, $uuid)
    {
        $notebook = Notebook::where('uuid', '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        $notebook->name = Input::input('name');
        $notebook->save();
        return $this->makeReturnArray($notebook);
    }
}
