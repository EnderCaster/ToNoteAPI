<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('notebooks', 'NotebookController@index');
Route::get('partitions', 'PartitionController@index');
Route::get('pages', 'PageController@index');
Route::get('pages/{uuid}', 'PageController@one');
