<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('login');
});



Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post('/login', [AuthController::class, "login_post"])->name("login_post");
Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class, "register_post"])->name("register_post");



Route::get('/forgot', [AuthController::class, "forgot"])->name("forgot");
Route::post('/processForgotpassword', [AuthController::class, "processForgotpassword"])->name("processForgotpassword");
Route::get('reset_password/{token}', [AuthController::class, "reset_password"])->name('reset_password');
Route::post('ProcessResetPassword', [AuthController::class, "ProcessResetPassword"])->name('ProcessResetPassword');



// Route::view('admin','admin.admin_layout');

Route::middleware(['auth'])->group(function () {
    Route::get('/index', [IndexController::class, "index"])->name("index");
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [UserController::class, "user_profile"])->name("user_profile");
    Route::POST('/image_update', [UserController::class, "image_update"])->name("image_update");
    Route::POST('/user_detail_update', [UserController::class, "user_detail_update"])->name("user_detail_update");


});


Route::middleware(['CheckRoles'])->prefix('admin')->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/user_list', [AdminController::class, 'user_list'])->name('user_list');
    Route::get('/user_edit/{id}', [AdminController::class, 'user_edit'])->name('user_edit');
    Route::get('/add_user', [AdminController::class, 'add_user'])->name('add_user');
    Route::post('/add_user_data', [AdminController::class, 'add_user_data'])->name('add_user_data');
    Route::post('/add_img_edit/{id}', [AdminController::class, 'add_img_edit'])->name('add_img_edit');
    Route::delete('/user_delet/{id}', [AdminController::class, 'user_delet'])->name('user_delet');
});


