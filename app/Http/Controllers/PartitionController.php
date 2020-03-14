<?php

namespace App\Http\Controllers;

use App\Partition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class PartitionController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'parent' => 'required'
        ], config('validation')['partitions']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $partitions = Partition::query()->where('parent', '=', $request->input('parent'))->where('uid', '=', $request->user()->id)->get();
        return $this->makeReturnArray($partitions);
    }

    public function add(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'parent' => 'required',
            'name' => 'required',
        ], config('validation')['partitions']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $partition = new Partition();
        $partition->uid = $request->user()->id;
        $partition->parent = $request->input('parent');
        $partition->uuid = strtoupper(Uuid::uuid1()->getHex());
        $partition->name = $request->input('name');
        $partition->save();
        return $this->makeReturnArray($partition);
    }

    public function delete(Request $request, $uuid)
    {
        $partition = Partition::where('uuid', '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        if (empty($partition)) {
            return $this->makeReturnArray([], 404, $this->lang('names.partitions') . $this->lang('msg.not-found') . ',' . $this->lang('msg.retry'));
        }
        $partition->delete();
        return $this->makeReturnArray($partition);
    }
    public function save(Request $request, $uuid)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'name' => 'required',
        ], config('validation')['partitions']);
        if ($validator->fails()) {
            return $this->makeReturnArray($validator->errors()->messages(), 403, '');
        }
        $partition = Partition::where('uuid', '=', $uuid)->where('uid', '=', $request->user()->id)->first();
        $partition->name = $request->input('name');
        $partition->save();
        return $this->makeReturnArray($partition);
    }
}
