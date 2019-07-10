<?php

namespace App\Http\Controllers;

use App\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    public function index(){
        return Notebook::all();
    }
}
