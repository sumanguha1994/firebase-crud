<?php
use Illuminate\Support\Facades\Route;

Route::resource('/init', 'Setup');
Route::group(['middleware' => 'appname'], function(){
    Route::get('/dashboard', 'Common@index');
    Route::post('/get-table-value', 'Common@create');
    Route::post('/del-table-data', 'Common@destroy');
    Route::get('/get-table-index/{tblname}', 'Common@show');
    Route::post('/add-new-entry', 'Common@store');
    Route::post('/get-single-table-data', 'Common@edit');
    Route::post('/update-entry', 'Common@update');

    Route::get('/create-table', 'Table@index');
    Route::post('/create-table-form', 'Table@store');

    Route::get('/file-upload', 'Fileupload@index');
    Route::post('/file-upload-form', 'Fileupload@store');
    Route::post('/get-upload-file-link', 'Fileupload@show');
    Route::post('/delete-upload-file', 'Fileupload@destroy');

    Route::get('/web-send-notification', 'Notification@index');
    Route::post('/create-web-Notification-form', 'Notification@store');
    Route::get('/send-notification', 'Notification@create');

    Route::get('/logout', 'Table@destroy');
});