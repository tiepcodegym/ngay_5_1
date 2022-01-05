<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware("auth")->group(function (){
    Route::prefix('users')->group(function (){
        Route::get('/',[UserController::class,'index'])->name('users.index');
        Route::get('/create',[UserController::class,'create'])->name('users.create');
        Route::post('/create',[UserController::class,'store'])->name('users.store');
        Route::get('/{id}/detail',[UserController::class,'show'])->name('users.show');
        Route::get('/{id}/delete',[UserController::class,'destroy'])->name('users.destroy');

        Route::prefix('posts')->group(function (){
            Route::get('/',[PostController::class,'index'])->name('posts.index');
            Route::get('/create',[PostController::class,'create'])->name('posts.create');
            Route::post('/create',[PostController::class,'store'])->name('posts.store');
            Route::get('/{id}/detail',[PostController::class,'show'])->name('posts.show');
            Route::get('/{id}/update',[PostController::class,'edit'])->name('posts.edit');
            Route::post('/{id}/update',[PostController::class,'update'])->name('posts.update');
            Route::get('/{id}/delete',[PostController::class,'destroy'])->name('posts.destroy');
            Route::get('/{id}/bookmark',[PostController::class,'addToFavorite'])->name('posts.addToFavorite');
            Route::get('/favorite',[PostController::class,'showFavoriteList'])->name('posts.showFavoriteList');
            Route::get('/{id}/deleteFavorite',[PostController::class,"deleteFavorite"])->name("deleteFavorite");

        });
    });

    });




Route::get("/login",[\App\Http\Controllers\AuthController::class,'showFormLogin'])->name('login.showFormLogin');
Route::post("/login",[\App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::get("/logout",[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
Route::get("/register",[\App\Http\Controllers\AuthController::class,'showFormRegister'])->name('register.showFormRegister');
Route::post("/register",[\App\Http\Controllers\AuthController::class,'register'])->name('register');
