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

Route::get('/', function () {
    return "Hello World";
});
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('logout', 'UserController@logout');

Route::get('file/{user}/{filename}', ['uses' => 'FileController@storage']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('notebooks', 'NotebookController@index');
    Route::post('notebooks', 'NotebookController@add');
    Route::patch('notebooks/{uuid}', 'NotebookController@save');
    Route::put('notebooks/{uuid}', 'NotebookController@save');
    Route::delete('notebooks/{uuid}', 'NotebookController@delete');


    Route::get('partitions', 'PartitionController@index');
    Route::post('partitions', 'PartitionController@add');
    Route::patch('partitions/{uuid}', 'PartitionController@save');
    Route::put('partitions/{uuid}', 'PartitionController@save');
    Route::delete('partitions/{uuid}', 'PartitionController@delete');

    Route::get('pages', 'PageController@index');
    Route::get('pages/{uuid}', 'PageController@one');
    Route::post('pages', 'PageController@add');
    Route::patch('pages/{uuid}', 'PageController@save');
    Route::patch('put/{uuid}', 'PageController@save');
    Route::delete('pages/{uuid}', 'PageController@delete');

    Route::post('file/upload', 'FileController@upload');
});
