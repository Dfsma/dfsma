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

Route::get('/test-orm', 'PruebasController@testOrm');
Route::get('/post/pruebas', 'PostController@pruebas');


Route::post('/api/register', 'UserController@register');
Route::post('/api/login', 'UserController@login');

Route::resource('/api/post', 'PostController'); //Resource crea las rutas automaticas para cada metodo.

