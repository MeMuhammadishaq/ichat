<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
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
Route::get('/change-password',function(){

    return view('change-password');
});
Route::get('/',[UserController::class,'read'])->name('welcome')->middleware('auth');
Route::get('/setting',[UserController::class,'profile'])->name('setting')->middleware('auth');
Route::post('setting',[UserController::class,'upload'])->name('upload')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('fetchmsg',[MessageController::class,'fetchmsg'])->name('fetchmsg');
Route::post('/insertmsg',[MessageController::class,'insertmsg'])->name('insertmsg');

