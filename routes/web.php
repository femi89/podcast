<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('comment/create',[PodcastController::class, 'createComment'])->name('comment.create');
Route::get('poadcast/{podcast}/like',[PodcastController::class, 'likePodcast'])->name('podcasts.like');
Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::get('podcasts', [PodcastController::class, 'index'])->name(
            'podcasts.index'
        );
        Route::post('podcasts', [PodcastController::class, 'store'])->name(
            'podcasts.store'
        );
        Route::get('podcasts/create', [PodcastController::class, 'create',])->name('podcasts.create');
        Route::get('podcasts/{podcast}/edit', [
            PodcastController::class,
            'edit',
        ])->name('podcasts.edit');
        Route::put('podcasts/{podcast}', [
            PodcastController::class,
            'update',
        ])->name('podcasts.update');
        Route::delete('podcasts/{podcast}', [
            PodcastController::class,
            'destroy',
        ])->name('podcasts.destroy');

        Route::get('albums', [AlbumController::class, 'index'])->name(
            'albums.index'
        );
        Route::post('albums', [AlbumController::class, 'store'])->name(
            'albums.store'
        );
        Route::get('albums/create', [AlbumController::class, 'create'])->name(
            'albums.create'
        );
        Route::get('albums/{album}', [AlbumController::class, 'show'])->name(
            'albums.show'
        );
        Route::get('albums/{album}/edit', [
            AlbumController::class,
            'edit',
        ])->name('albums.edit');
        Route::put('albums/{album}', [AlbumController::class, 'update'])->name(
            'albums.update'
        );
        Route::delete('albums/{album}', [
            AlbumController::class,
            'destroy',
        ])->name('albums.destroy');

        Route::get('comments', [CommentController::class, 'index'])->name(
            'comments.index'
        );
        Route::post('comments', [CommentController::class, 'store'])->name(
            'comments.store'
        );
        Route::get('comments/create', [
            CommentController::class,
            'create',
        ])->name('comments.create');
        Route::get('comments/{comment}', [
            CommentController::class,
            'show',
        ])->name('comments.show');
        Route::get('comments/{comment}/edit', [
            CommentController::class,
            'edit',
        ])->name('comments.edit');
        Route::put('comments/{comment}', [
            CommentController::class,
            'update',
        ])->name('comments.update');
        Route::delete('comments/{comment}', [
            CommentController::class,
            'destroy',
        ])->name('comments.destroy');

        Route::get('likes', [LikeController::class, 'index'])->name(
            'likes.index'
        );
        Route::post('likes', [LikeController::class, 'store'])->name(
            'likes.store'
        );
        Route::get('likes/create', [LikeController::class, 'create'])->name(
            'likes.create'
        );
        Route::get('likes/{like}', [LikeController::class, 'show'])->name(
            'likes.show'
        );
        Route::get('likes/{like}/edit', [LikeController::class, 'edit'])->name(
            'likes.edit'
        );
        Route::put('likes/{like}', [LikeController::class, 'update'])->name(
            'likes.update'
        );
        Route::delete('likes/{like}', [LikeController::class, 'destroy'])->name(
            'likes.destroy'
        );

        Route::get('guests', [GuestController::class, 'index'])->name(
            'guests.index'
        );
        Route::post('guests', [GuestController::class, 'store'])->name(
            'guests.store'
        );
        Route::get('guests/create', [GuestController::class, 'create'])->name(
            'guests.create'
        );
        Route::get('guests/{guest}', [GuestController::class, 'show'])->name(
            'guests.show'
        );
        Route::get('guests/{guest}/edit', [
            GuestController::class,
            'edit',
        ])->name('guests.edit');
        Route::put('guests/{guest}', [GuestController::class, 'update'])->name(
            'guests.update'
        );
        Route::delete('guests/{guest}', [
            GuestController::class,
            'destroy',
        ])->name('guests.destroy');

        Route::get('users', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('users', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('users/create', [UserController::class, 'create'])->name(
            'users.create'
        );
        Route::get('users/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name(
            'users.edit'
        );
        Route::put('users/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name(
            'users.destroy'
        );
    });

Auth::routes();
Route::get('podcasts/{podcast}', [
    PodcastController::class,
    'show',
])->name('podcasts.show');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home', 'podcasts');
