<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KpiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'home'])->name('home');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login_User',[AuthController::class ,'loginUser'])->name('login_User');

Route::middleware('auth')->group(function(){
    Route::get('/employees',[EmployeeController::class,'getEmployees'])->name('employees');
    Route::get('/evaluate',[EmployeeController::class,'evaluate'])->name('evaluate');

    //kpis
    Route::match(['get', 'post'],'/kpis',[KpiController::class, 'index'])->name('kpis');
    Route::match(['get','post'],'/list_kpis',[KpiController::class,'getKpis'])->name('list_kpis');
    Route::post('/store_position_kpi',[KpiController::class,'storePositionKpi'])->name('store_position_kpi');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});






