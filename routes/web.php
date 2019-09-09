<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TasksController@index');
Route::post('/task', 'TasksController@store');
Route::get('/show', 'TasksController@show');
Route::get('/task/{id}', 'TasksController@deleteTask');
Route::get('/user/{id}', 'TasksController@deleteUser');
Route::get('/task/edit/{id}', 'TasksController@editTask');


