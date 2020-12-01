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

Route::get('/ping', function(Request $request) {
    return ['pong' => true];
});

Route::get('/notes', 'NotesController@all');
Route::get('/notes/{id}', 'NotesController@one');
Route::post('/notes/add', 'NotesController@new');
Route::put('/notes/edit/{id}', 'NotesController@edit');
Route::get('/notes/delete/{id}', 'NotesController@deleteNote');