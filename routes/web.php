<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;

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
    //マイページ
    Route::get('/review/mypage', [ReviewController::class, 'mydata'])->name('review.mypage');

    //レビュー機能
    Route::get('/review/score', [ReviewController::class, 'indexScore'])->name('review.score');
    Route::resource('review', ReviewController::class);

    //タグ機能
    Route::resource('tag', TagController::class);

    //いいね機能
    Route::post('review/{review}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('review/{review}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

    //検索機能
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
});


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
