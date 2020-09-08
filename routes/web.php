<?php
use Illuminate\Support\Facades\Route;
Route::get('/', 'Common@index');
Route::get('/dashboard', 'Common@index');
Route::post('/get-table-value', 'Common@create');
Route::post('/del-table-data', 'Common@destroy');
Route::get('/get-table-index/{tblname}', 'Common@show');
Route::post('/add-new-entry', 'Common@store');
Route::post('/get-single-table-data', 'Common@edit');
Route::post('/update-entry', 'Common@update');

Route::get('/create-table', 'Table@index');
Route::post('/create-table-form', 'Table@store');