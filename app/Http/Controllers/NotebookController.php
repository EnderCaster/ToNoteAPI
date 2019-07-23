<?php

namespace App\Http\Controllers;

use App\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class NotebookController extends Controller
{
    public function index()
    {
        return Notebook::all();
    }

    public function add()
    {
        $notebook = new Notebook();
        $notebook->uuid = strtoupper(Uuid::uuid1()->getHex());
        $notebook->name = Input::input('name');
        //TODO get current uid
        $notebook->uid = 0;
        $notebook->save();
        return $notebook;
    }

    public function delete($uuid)
    {
        $notebook = Notebook::where('uuid', '=', $uuid)->first();
        $notebook->delete();
        return $notebook;

    }

    public function save($uuid)
    {
        $notebook = Notebook::where('uuid', '=', $uuid)->first();
        $notebook->name = Input::input('name');
        $notebook->save();
        return $notebook;
    }
}
