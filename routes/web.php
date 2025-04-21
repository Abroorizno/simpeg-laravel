<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\ModulDetailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/action-register', [RegisterController::class, 'store']);
// Route::resource('register', DashboardController::class);

Route::get('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('instructors', InstructorController::class);
    Route::resource('user_role', UserRoleController::class);
    Route::resource('students', StudentController::class);
    Route::resource('moduls', ModulController::class);
    Route::resource('modul_details', ModulDetailController::class);

    Route::get('users-account', [UserController::class, 'account'])->name('users-account');
    Route::put('users-account/{id}', [UserController::class, 'updateAccount'])->name('users.updateAccount');
});
