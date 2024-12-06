<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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

Route::get('/register', function () {return view('auth.register');})->name('register');

Route::get('/myinfo', function () {return view('auth.myinfo');})->name('myinfo');

Route::get('/top', function () {return view('posts.top');})->name('top');

Route::get('/result', function () {return view('posts.result');})->name('result');

Route::get('/post', [PostController::class, 'show'])->name('posts.post');

Route::get('/notification', function () {return view('posts.notification');})->name('notification');

Route::get('/mypage', function () {return view('posts.mypage');})->name('mypage');

Route::get('/edit', function () {return view('posts.edit');})->name('edit');

Route::get('/create', function () {return view('posts.create');})->name('create');