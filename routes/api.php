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
Route::post('login', 'UserController@login');
Route::get('myToken', 'UserController@newToken');

Route::middleware('auth:api')->get('notebooks', 'NotebookController@index');
Route::middleware('auth:api')->post('notebooks', 'NotebookController@add');
Route::middleware('auth:api')->patch('notebooks/{uuid}', 'NotebookController@save');
Route::middleware('auth:api')->put('notebooks/{uuid}', 'NotebookController@save');
Route::middleware('auth:api')->delete('notebooks/{uuid}', 'NotebookController@delete');


Route::middleware('auth:api')->get('partitions', 'PartitionController@index');
Route::middleware('auth:api')->post('partitions', 'PartitionController@add');
Route::middleware('auth:api')->patch('partitions/{uuid}', 'PartitionController@save');
Route::middleware('auth:api')->put('partitions/{uuid}', 'PartitionController@save');
Route::middleware('auth:api')->delete('partitions/{uuid}', 'PartitionController@delete');

Route::middleware('auth:api')->get('pages', 'PageController@index');
Route::middleware('auth:api')->get('pages/{uuid}', 'PageController@one');
Route::middleware('auth:api')->post('pages', 'PageController@add');
Route::middleware('auth:api')->patch('pages/{uuid}', 'PageController@save');
Route::middleware('auth:api')->patch('put/{uuid}', 'PageController@save');
Route::middleware('auth:api')->delete('pages/{uuid}', 'PageController@delete');
