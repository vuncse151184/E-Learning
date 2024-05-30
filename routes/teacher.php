<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\Auth\LoginController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Lesson\LessonController;

Route::controller(LoginController::class)->group(function (){
    Route::match(['get', 'post'],'/','login');
    Route::match(['get', 'post'], '/login', 'login')->name('teacher.login');
    Route::match(['get', 'post'],'/logout', 'logout')->name('teacher.logout');
});
Route::middleware('role:teacher')->group(function (){
    Route::controller(TeacherController::class)->group(function (){
        
        Route::get('/profile','index')->name('teacher.profile');
        Route::get('/lesson/create','create')->name('teacher.lesson.create');
        Route::post('/lesson/update','update')->name('teacher.profile.update');
        Route::post('/lesson-store','store')->name('teacher.lesson.store');
        Route::get('/lesson/view','view')->name('teacher.lesson.view');
        Route::get('/password/change','changePassword')->name('teacher.password-change');
        Route::post('/password/change-confirm','change')->name('teachher.passwordchanged');
        Route::post('/uploadimg','uploadimg')->name('teacher.uploadimg');
       
    });
    Route::controller(QuestionController::class)->group(function(){
        Route::get('/question/list','index')->name('teacher.question.list');
        Route::get('/question/create','create')->name('teacher.question.create');
        Route::get('/question/edit/{id}','edit')->name('teacher.question.edit');
        Route::post('/question/store','storeCreate')->name('teacher.question.store');
        Route::post('/question/update/{id}','update')->name('teacher.question.update');
        Route::delete('/question/delete/{id}','delete')->name('teacher.question.delete');
    });

    Route::controller(LessonController::class)->group(function(){
        Route::get('/lesson/list','index')->name('teacher.lessons-list');
        Route::get('/lesson/create','create')->name('teacher.lesson-create');
        Route::get('/lesson/edit/{id}','edit')->name('teacher.lesson-edit');
        Route::post('/lesson/store','store')->name('teacher.lesson.store');
        Route::post('/lesson/update/{id}','update')->name('teacher.lesson.update');
        Route::get('/lesson/viewlesson/{id}','viewlesson')->name('teacher.lesson.viewlesson');
        Route::post('/lesson/update-public','updatePublic')->name('teacher.lesson.updatePublic');
        Route::delete('/lesson-delete/{id}','delete')->name('teacher.lesson.delete');
    });
});


Route::get('/test',function(){
    return view('teacher.question.create');
});
Route::get('/test1',function(){
    return view('lesson.layouts.app');
});
