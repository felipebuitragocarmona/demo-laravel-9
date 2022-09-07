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

// Obtiene todos los permisos 
Route::get('permissions','PermissionsController@index');

// Obtiene un permiso en especifico
Route::get('permissions/{id}', 'PermissionsController@show');

// Agrega un nuevo permiso
Route::post('permissions', 'PermissionsController@store');

// Actualiza un permiso
Route::put('permissions/{id}', 'PermissionsController@update');

// Elimina un permiso
Route::delete('permissions/{id}', 'PermissionsController@destroy');