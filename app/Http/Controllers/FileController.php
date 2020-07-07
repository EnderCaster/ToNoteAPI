<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    function upload(Request $request)
    {
        $files = $request->file();
        if (empty($files)) {
            return $this->makeReturnArray([]);
        }
        // TODO 上传到图床
        $file_parameter_name = array_keys($files)[0];
        $user = $request->user();
        $username = $user->name;
        $file = $files[$file_parameter_name];
        $file_path = Storage::putFile("{$username}", $file);

        return $this->makeReturnArray([
            'url' => $file_path
        ]);
    }
    function storage(Request $request, $user, $filename)
    {
        $logedin_user = $request->user();
        if (empty($logedin_user) || $logedin_user['name'] != $user) {
            return $this->makeReturnArray([], 403, "Auth Failed");
        }
        return Storage::download("{$user}/{$filename}");
    }
}
