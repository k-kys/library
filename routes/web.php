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

// STUDENT
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('student.login');
});
Route::get('/home', function () {
    return view('student.home');
});
Route::get('/borrow', function () {
    return view('student.borrow');
});
Route::get('/profile', function () {
    return view('student.profile');
});
Route::get('/change-password', function () {
    return view('student.change-password');
});
Route::get('/reset-password', function () {
    return view('student.reset-password');
});

Route::prefix('admin')->group(function () {
    Route::get('home', function () {
        return view('admin.home');
    });
    Route::get('category', function () {
        return view('admin.category');
    });
});
