<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Livewire\Posts;
use App\Livewire\CreatePost;
use Livewire\Livewire;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/posts',PostsController::class);
//Route::get('/livewire-posts',[PostsController::class,'index_livewire']);

Route::get('livewire/posts',Posts::class);
Route::get('/livewire/posts/create',CreatePost::class);
