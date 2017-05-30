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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','InvoicesController@index');
Route::post('/Search','InvoicesController@search');
Route::get('/new','InvoicesController@create');
Route::post('/store','InvoicesController@store');
Route::get('/pdf/{id}','InvoicesController@pdfexp');
Route::get('/update/{invoice}','InvoicesController@update');
Route::put('/restore/{id}','InvoicesController@restore');
Route::get('/remove/{id}','InvoicesController@remove');