<?php

namespace App\Http\Controllers;

use App\Partition;
use Illuminate\Http\Request;

class PartitionController extends Controller
{
    public function index(Request $request){
        return Partition::all()->where('parent','=',$request->input('parent'));
}
}
