<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/docs','FolderController@docs');
Route::get('/folder/{id}','FolderController@folder');
Route::post('/docs','FolderController@doc_store');
Route::post('/folder','FolderController@fol_store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
