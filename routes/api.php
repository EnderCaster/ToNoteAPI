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
Route::post('login', 'App\\Http\\Controllers\\UserController@login');
Route::post('register', 'App\\Http\\Controllers\\UserController@register');
Route::post('logout', 'App\\Http\\Controllers\\UserController@logout');



Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return ['code' => 200, "data" => $request->user()];
    });
    Route::get('notebooks', 'App\\Http\\Controllers\\NotebookController@index');
    Route::post('notebooks', 'App\\Http\\Controllers\\NotebookController@add');
    Route::patch('notebooks/{uuid}', 'App\\Http\\Controllers\\NotebookController@save');
    Route::put('notebooks/{uuid}', 'App\\Http\\Controllers\\NotebookController@save');
    Route::delete('notebooks/{uuid}', 'App\\Http\\Controllers\\NotebookController@delete');


    Route::get('partitions', 'App\\Http\\Controllers\\PartitionController@index');
    Route::post('partitions', 'App\\Http\\Controllers\\PartitionController@add');
    Route::patch('partitions/{uuid}', 'App\\Http\\Controllers\\PartitionController@save');
    Route::put('partitions/{uuid}', 'App\\Http\\Controllers\\PartitionController@save');
    Route::delete('partitions/{uuid}', 'App\\Http\\Controllers\\PartitionController@delete');

    Route::get('pages', 'App\\Http\\Controllers\\PageController@index');
    Route::get('pages/{uuid}', 'App\\Http\\Controllers\\PageController@one');
    Route::post('pages', 'App\\Http\\Controllers\\PageController@add');
    Route::patch('pages/{uuid}', 'App\\Http\\Controllers\\PageController@save');
    Route::patch('put/{uuid}', 'App\\Http\\Controllers\\PageController@save');
    Route::delete('pages/{uuid}', 'App\\Http\\Controllers\\PageController@delete');

    Route::post('file/upload', 'App\\Http\\Controllers\\FileController@upload');

    Route::get('file/{user}/{filename}', ['uses' => 'App\\Http\\Controllers\\FileController@storage']);
});
