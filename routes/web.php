<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;

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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Route::get('/dashboard', function () {
    //     $posts = Post::all();
    //     return view('dashboard', [
    //         'posts' => $posts,
    //     ]);
    // })->name('dashboard');

    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    Route::post('/add-post', [PostController::class, 'addPost'])->name('add.post');
    Route::get('/edit-post/{id}', [PostController::class, 'editPost'])->name('edit.post');
    Route::post('/update-post', [PostController::class, 'updatePost'])->name('update.post');
    Route::post('/delete-post', [PostController::class, 'deletePost'])->name('delete.post');
});