<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
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

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/forum', 'forum')->name('forum');
    Route::get('/forum/create', 'forumCreate')->name('forum.create');
    Route::post('/forum/create', 'forumStore')->name('forum.store');
    Route::get('/forum/{forum}', 'forumShow')->name('forum.show');
    Route::post('/forum/{forum}/thread', 'forumReply')->name('forum.reply');
    Route::post('ckeditor/upload', 'ckeditorUpload')->name('ckeditor.upload');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
