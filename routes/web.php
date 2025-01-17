<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
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

//Route::get('/upload', function () {
//    return view('upload');
//});

use App\Http\Controllers\OSSUploadController;

//Route::post('/upload', [OSSUploadController::class, 'upload']);


Route::get('/upload-form', function () {
    return view('upload');
});

Route::post('/upload', [OSSUploadController::class, 'upload']);
