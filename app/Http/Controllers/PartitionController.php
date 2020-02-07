<?php

namespace App\Http\Controllers;

use App\Partition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class PartitionController extends Controller
{
    public function index(Request $request)
    {
        $partitions = Partition::query()->where('parent', '=', $request->input('parent'))->where('uid', '=', $request->user()->id)->get();
        return $this->makeReturnArray($partitions);
    }

    public function add()
    {
        $partition = new Partition();
        $partition->uid = \request()->user()->id;
        $partition->parent = Input::input('parent');
        $partition->uuid = strtoupper(Uuid::uuid1()->getHex());
        $partition->name = Input::input('name');
        $partition->save();
        return $this->makeReturnArray($partition);
    }

    public function delete($uuid)
    {
        $partition = Partition::where('uuid', '=', $uuid)->where('uid', '=', \request()->user()->id)->first();
        $partition->delete();
        return $this->makeReturnArray($partition);
    }
    public function save($uuid)
    {
        $partition = Partition::where('uuid', '=', $uuid)->where('uid', '=', \request()->user()->id)->first();
        $partition->name = Input::input('name');
        $partition->save();
        return $this->makeReturnArray($partition);
    }
}
