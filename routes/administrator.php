<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator\Auth\LoginController;
use App\Http\Controllers\Administrator\AdminController;

Route::match(['get', 'post'], '/', [LoginController::class, 'login'])->name('administrator.login');
Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('administrator.login');
Route::match(['get', 'post'],'/logout', [LoginController::class, 'logout'])->name('administrator.logout');

Route::middleware([
    // 'auth:administrator',

'role:administrator,teacher'])->group(function (){  
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::match(['get', 'post'], '/teacher-list', [AdminController::class, 'index'])->name('administrator.teacher');
    Route::match(['get', 'post'], '/tags-list', [AdminController::class, 'view_tags'])->name('administrator.tags');
    Route::post('/add-tag',[AdminController::class, 'create_tag'])->name('administrator.add-tag');
    Route::post('/update-tag',[AdminController::class, 'update_tag'])->name('administrator.update-tag');
    Route::post('/delete-tag',[AdminController::class, 'delete_tag'])->name('administrator.delete-tag');
    Route::get('/teacher-add', [AdminController::class, 'create'])->name('administrator.teacher.create');
    Route::post('/teacher-store',[AdminController::class,'store'])->name('administrator.teacher.store');
    Route::get('/teacher-edit/{teacher}', [AdminController::class, 'edit'])->name('administrator.teacher.edit');
    Route::patch('/teacher-update/{teacher}', [AdminController::class, 'update'])->name('administrator.teacher.update');
    Route::delete('/teacher-delete/{teacher}',[AdminController::class,'destroy'])->name('administrator.teacher.delete');
});


