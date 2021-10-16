<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use APP\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;

// 会員登録
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
// ログイン / ログアウト
Route::prefix('auth')->group(function () {
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 出店関連
Route::resource('stores', StoreController::class);
Route::post('stores/search', [App\Http\Controllers\StoreController::class, 'search'])->name('stores.search');
// 商品関連
Route::resource('products', ProductController::class);
// クチコミ関連
Route::resource('reviews', ReviewController::class);
// Route::post('reviews/store', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
// Route::get('reviews/show', [App\Http\Controllers\ReviewController::class, 'show'])->name('reviews.show');
