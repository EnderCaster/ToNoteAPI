<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    static $lang = [];
    function __construct()
    {
        self::$lang = config('i18n');
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function makeReturnArray($data, $code = 200, $message = 'OK')
    {
        Log::info($data);
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
    public function lang($name = '')
    {
        $name = explode('.', $name);
        $result = self::$lang;
        foreach ($name as $key) {
            if (!array_key_exists($key, $result)) {
                return implode('.', $name);
            }
            $result = $result[$key];
        }
        return $result;
    }
}
