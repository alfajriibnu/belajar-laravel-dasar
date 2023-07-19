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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function () {
    return "Hallo Programmer Zaman Now";
});

Route::redirect('/youtube', 'pzn');

Route::fallback(function (){
    return "404 by Programmer Zaman Now";
});

Route::view('/hello', 'hello', ['name' => 'Ibnu']);

Route::get('/hello-again', function(){
    return view('hello', ['name' => 'Ibnu']);
});

Route::get('/hello-world', function(){
    return view('hello.world', ['name' => 'Ibnu']);
});

