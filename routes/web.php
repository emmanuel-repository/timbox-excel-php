<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view('welcome');});
// Route::get('/excel_import', 'ExcelImportController@index')->name('excel_import');
// Route::get('/create_import', 'ExcelImportController@create')->name('create');
Route::resource('excel_import', 'ExcelController');
// Route::resource('/excel_import', 'ExcelImportController')->name('excel_import');
// Route::resource('excel_import', 'ExcelImportController')->name('');