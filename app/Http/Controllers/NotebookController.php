<?php

namespace App\Http\Controllers;

use App\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class NotebookController extends Controller
{
    public function index(){
        return Notebook::all();
    }
    public function add(){
        $notebook=new Notebook();
        $notebook->uuid=Uuid::uuid1()->getHex();
        //TODO 解放
//        $notebook->name=Input::input('name');
        //TODO get current uid
        $notebook->uid=0;
        $notebook->name=$notebook->uuid;
        $notebook->save();
        return $notebook;
    }
    public function delete($uuid){}
}
