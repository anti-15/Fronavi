<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FavoriteController;
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
Route::group(['middleware' => 'auth'], function () {
    //レビュー機能
    Route::get('/review/score', [ReviewController::class, 'indexScore'])->name('review.score');
    Route::resource('review', ReviewController::class);

    //タグ機能
    Route::resource('tag', TagController::class);

    //いいね機能
    Route::post('review/{review}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('review/{review}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
