<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    function upload(Request $request){
        $files=$request->file();
        if (empty($files)){
            return "OK";
        }
        // TODO 上传到图床
        $file_parameter_name=array_keys($files)[0];
        $url='https://i2.hdslb.com/bfs/face/f7d8bd2186303bf7b12895607d3af2b09df3d9cc.jpg';
        return [
            'url'=>$url
        ];
    }
}
