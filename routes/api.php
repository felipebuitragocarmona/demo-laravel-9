<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\PermissionsController;
Route::controller(PermissionsController::class)->group(function () {
    Route::get('permissions','index'); //Para obtener todos
    Route::get('permissions/{id}', 'show'); //Para consultar especifico
    Route::post('permissions', 'store'); //Para guardar
    Route::put('permissions/{id}', 'update'); //Para actualizar
    Route::delete('permissions/{id}', 'destroy'); //Para eliminar un registro
});

use App\Http\Controllers\UsersController;
Route::controller(UsersController::class)->group(function () {
    Route::get('users','index');
    //->middleware(['user-access'])
    Route::get('users/export', 'exportAllUsers');
    Route::get('users/export/pdf', 'exportAllUsersPDF');
    Route::get('users/{id}', 'show');
    //->middleware(['user-access','permission-access'] 
    Route::post('users', 'store'); 
    Route::put('users/{id}', 'update'); 
    Route::delete('users/{id}', 'destroy'); 
    
});

// Route::middleware(['user-access'])->group(function () {
  
    
// });

use App\Http\Controllers\SecurityController;
Route::controller(SecurityController::class)->group(function () {
    Route::post('login', 'login'); 
    Route::post('logout', 'logout'); 
});

use App\Http\Controllers\RolesController;
Route::controller(RolesController::class)->group(function () {
    Route::get('roles','index')->middleware(['user-access','permission-access']);
    Route::get('roles/{id}', 'show')->middleware(['user-access','permission-access']); 
    Route::post('roles', 'store'); 
    Route::put('roles/{id}', 'update'); 
    Route::delete('roles/{id}', 'destroy'); 
    Route::get('roles/reports/count/{id}', 'count'); 
    Route::get('roles/reports/quantities-by-roles', 'quantitiesByRoles'); 
    
});

use App\Http\Controllers\ProfilesController;
Route::controller(ProfilesController::class)->group(function () {
    Route::get('profiles','index');
    Route::get('profiles/{id}', 'show'); 
    Route::post('profiles', 'store'); 
    Route::post('profiles/{id}', 'update'); 
    Route::delete('profiles/{id}', 'destroy'); 
});
