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

//Route::get('/', function () {
//    return view('index');
//});
//
//Route::get('/admin', function () {
//    return view('admin');
//})->middleware('bearer')->middleware('isAdmin');
//Route::get('/admin/{any}', function () {
//    return view('admin');
//})->where('any', '.*')->middleware('bearer')->middleware('isAdmin');
//Route::get('/{any}', function () {
//    return view('index');
//})->where('any', '.*');

Route::get('/', function () {
    return view('index');
});
Route::get('/admin', function () {
    return view('index');
});
Route::get('/prepod', function () {
    return view('index');
});
