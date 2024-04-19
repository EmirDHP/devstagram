<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrerController;
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

Route::get('/', function () {
    return view('principal');
});


Route::get('/register', [RegistrerController::class,'index'])->name('register');
Route::post('/register', [RegistrerController::class,'store']);

Route::get('/muro',[PostController::class,'index'])->name('posts.index');
