<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});
/* Route::get('/empleados', function () {
    return view('empleados.index');
});

Route::get('/empleados/create', [EmpleadoController::class, 'create']);
Route::get('/empleados/edit', [EmpleadoController::class, 'edit']); */

Route::resource('/empleados', EmpleadoController::class)->middleware('auth');
Auth::routes(['register'=>false, 'reset'=>false]);

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');


Route::group(['middleware'=>'auth'], function(){
    
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');

});