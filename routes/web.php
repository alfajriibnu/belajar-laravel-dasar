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

Route::get('/products/{id}', function($productId){
    return "Product $productId";
});

Route::get('/products/{product}/items/{item}', function($productId, $itemId){
    return "Product $productId, Item $itemId";
});

Route::get('/categories/{id}', function($categoriesId){
    return "Category $categoriesId";
})->where('id', '[0-9]+');

Route::get('/users/{id?}', function($userId = '404'){
    return "User $userId";
});

Route::get('/conflict/ibnu', function(){
    return 'Conflict Ibnu Al Fajri';
});

Route::get('/conflict/{name}', function($name){
    return 'Conflict $name';
});




