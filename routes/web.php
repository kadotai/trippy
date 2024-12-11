<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;


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

Route::get('/', function () {return view('welcome');})->name('welcome');

Route::get('/login', function () {return view('auth.login');})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/register', function () {return view('auth.register');})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/myinfo', function () {return view('auth.myinfo');})->name('myinfo');

Route::get('/top', [PostController::class, 'index'])->name('posts.top');

Route::get('/result',[PostController::class, 'showResults'])->name('posts.result');

Route::get('/post', [PostController::class, 'show'])->name('posts.post');

Route::get('/notification', function () {return view('posts.notification');})->name('notification');

Route::get('/mypage', function () {return view('posts.mypage');})->name('mypage');

Route::get('/edit', function () {return view('posts.edit');})->name('edit');

Route::get('/create', function () {return view('posts.create');})->name('create');

Route::post('/save-route', [RouteController::class, 'store']);




