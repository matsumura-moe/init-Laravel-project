<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\MatchingController; // 追記
use App\Http\Controllers\FavoritesController; // 追記
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
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {                                    // 追記
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);     // 追記
    Route::get('matching', [MatchingController::class, 'show'])->name('matching');
});

Route::group(['prefix' => 'idols/{id}'], function () {                                             // 追加
    Route::post('favorites', [FavoritesController::class, 'store'])->name('favorites.favorite');        // 追加
    Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite'); // 追加
}); 

Route::put('/user/{id}/update-image', [UsersController::class, 'updateImage'])->name('user.updateImage');
