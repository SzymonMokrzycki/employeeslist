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
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\ListDispController::class, 'index']);
Route::get('/home/{filter}', [App\Http\Controllers\ListDispController::class, 'filter']);
Route::get('/filteremp', [App\Http\Controllers\ListDispController::class, 'filterOptionEmployees']);
Route::get('/filterdep', [App\Http\Controllers\ListDispController::class, 'filterOptionDepartment']);
Route::get('/filterrange', [App\Http\Controllers\ListDispController::class, 'rangeSalary']);
Route::get('/export', [App\Http\Controllers\ListDispController::class, 'export']);