<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\UserController;



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

// Route::get('/myinfo', function () {return view('auth.myinfo');})->name('myinfo');

// Route::get('/myinfo', [UserController::class, 'edit'])->name('myinfo');

Route::post('/myinfo', [UserController::class, 'update'])->name('myinfo');

Route::get('/myinfo', [UserController::class, 'edit'])->name('myinfo.edit');

Route::put('/myinfo/update', [UserController::class, 'update'])->name('myinfo.update');

Route::get('/top', [PostController::class, 'index'])->name('posts.top');

// Route::get('/result',[PostController::class, 'showResults'])->name('posts.result');

// Route::get('/result', [PostController::class, 'result'])->name('posts.result');
// Route::get('/result',function () {return view('posts.result');})->name('result');
//↑これあってるかわかんないからいい感じにしてください：太田
Route::get('/result', [PostController::class, 'showResults'])->name('posts.result');

Route::get('/post', [PostController::class, 'show'])->name('posts.post');

Route::get('/notification', function () {return view('posts.notification');})->name('notification');

Route::get('/mypage', [MyPageController::class, 'show'])->name('mypage');

Route::patch('/mypage', [MyPageController::class, 'getPrefectures'])->name('mypage');

Route::get('/edit', function () {return view('posts.edit');})->name('edit');

// Route::get('/create', function () {return view('posts.create');})->name('create');

Route::post('/create', [RouteController::class, 'store']);

Route::get('/create', [PostController::class, 'create'])->name('posts.create');

Route::get('/search', [PostController::class, 'search']);

Route::get('/search', [PostController::class, 'search'])->name('posts.search');

Route::post('/post', [PostController::class, 'store'])->name('posts.store');

// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



