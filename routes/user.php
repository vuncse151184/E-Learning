<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/login', function () {
    return view('user.auth.login');
})->name('home.login');

Route::get('/register', function () {
    return view('user.auth.register');
})->name('user.registerpage');

Route::controller(LoginController::class)->group(function () {
    Route::post('/logged-in', 'login')->name('user.login');
    Route::post('/register', 'register')->name('user.register');
    Route::get('/logout', 'logout')->name('user.logout');
    Route::prefix('facebook')->group(function () {
        Route::get('/auth', 'loginFb')->name('user.loginFb');
        Route::get('/callback', 'callbackFromFacebook')->name('user.fbcallback');
    });
});
// Route::middleware('auth:user')->group(function(){
Route::controller(UserController::class)->group(function () {
    Route::get('/viewlesson/{id}', 'view')->name('view');
    Route::get('/lop/{i}', 'viewByGrade')->name('user.view-by-grade');
    Route::get('/home', 'index')->name('user.home');
    Route::post('/store-result', 'store')->name('user.store-result');
});


// });
