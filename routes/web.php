<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Jobs\CreateEvaluationJob;
use Illuminate\Support\Facades\Auth;
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

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login_User', [AuthController::class, 'loginUser'])->name('login_User');

Route::middleware('auth')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'getEmployees'])->name('employees');

    //kpis (manager)
    Route::match(['get', 'post'], '/kpis', [KpiController::class, 'index'])->name('kpis');
    Route::match(['get', 'post'], '/list_kpis', [KpiController::class, 'getKpis'])->name('list_kpis');
    Route::post('/store_position_kpi', [KpiController::class, 'storePositionKpi'])->name('store_position_kpi');


    Route::get('/fetch_kpis', [KpiController::class, 'fetchKpis'])->name('fetch_kpis');
    Route::match(['get', 'post'], '/all_kpis', [KpiController::class, 'getAllKpis'])->name('all_kpis');
    Route::get('/show_kpi',[KpiController::class,'show'])->name('show_kpi');

    //evaluation
    Route::match(['get', 'post'],'/evaluate', [EvaluationController::class, 'index'])->name('evaluate');
    Route::match(['get', 'post'], '/list_emp_kpi', [EvaluationController::class, 'empKpisAndComptencies'])->name('list_emp_kpi');
    Route::post('/store_emp_eval', [EvaluationController::class, 'storeEmpEval'])->name('store_emp_eval');


    Route::get('/fetch_evaluations',[EvaluationController::class, 'fetchEvaluations'])->name('fetch_evaluations');
    Route::match(['get', 'post'], '/all_evaluations', [EvaluationController::class, 'getAllEvaluations'])->name('all_evaluations');
    Route::get('/show_emp',[EvaluationController::class,'show'])->name('show_emp');

//    Route::get('/create_emp_eval_row',function (){
//        CreateEvaluationJob::dispatch(Auth::id());
//    });

    Route::get('/show_my_eval', [EmployeeController::class, 'myevaluation'])->name('myEval');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/my_profile',[UserController::class,'getProfile'])->name('profile');

    //change password
    Route::get('/change_password_request',[AuthController::class,'getView'])->name('change_password_request');
    Route::match(['get','post'],'/store_new_password',[AuthController::class,'storePassword'])->name('store_new_password');



    //permissions
    Route::get('/get_permissions',[PermissionController::class,'index'])->name('get_permissions');
    Route::get('/show_permission/{id}',[PermissionController::class,'getPermission'])->name('show_permission');
    Route::get('/get_all_permissions',[PermissionController::class,'getAll'])->name("get_all_permissions");
    Route::post('/create_permission',[PermissionController::class,'create'])->name('create_permission');
    Route::match(['get','post'],'/update_permission',[PermissionController::class,'update'])->name('update_permission');
    Route::get('/delete_permission/{id}',[PermissionController::class,'destroy'])->name('delete_permission');



    //permission groups
    Route::get('/get_Permission_groups',[PermissionGroupController::class,'index'])->name('get_Permission_groups');
    Route::get('/show_permission_groups',[PermissionGroupController::class,'getAll'])->name('show_permission_groups');
    Route::post('/create_permission_group',[PermissionGroupController::class,'create'])->name('create_permission_group');

    //Roles
    Route::get('/get_roles',[RoleController::class,'index'])->name('get_roles');
    Route::get('/get_all_roles',[RoleController::class,'getAll'])->name("get_all_roles");
    Route::get('/show_role/{id}',[RoleController::class,'get'])->name('show_role');
    Route::get('/show_all',[RoleController::class,'showAll'])->name('show_all');
    Route::match(['get','post'],'/create_role',[RoleController::class,'create'])->name('create_role');
    Route::match(['get','post'],'/update_role',[RoleController::class,'update'])->name('update_role');
    Route::get('/delete_role/{id}',[RoleController::class,'destroy'])->name('delete_role');

});





