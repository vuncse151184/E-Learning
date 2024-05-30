<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

// Route::get('/home', function(){
//     return view('user.app');
// })->name('home');

Route::get('/login',function(){
    return redirect()->route('home.login');
});
Route::get('/viewlesson/{id}',[UserController::class,'view'])->name('view');
Route::get('/',[UserController::class, 'index']);
Route::get('/home',[UserController::class,'index'])->name('home');
Route::post('/store-result',[UserController::class,'store'])->name('user.store-result');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('/administrator/teacher', App\Http\Controllers\TeacherController::class);
