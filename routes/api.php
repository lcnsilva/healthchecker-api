<?php

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('sites')->name('sites.')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('index');
    Route::post('/', [SiteController::class, 'store'])->name('store');
    Route::get('/{site}', [SiteController::class, 'show'])->name('show');
    Route::put('/{site}', [SiteController::class, 'update'])->name('update');
    Route::delete('/{site}', [SiteController::class, 'destroy'])->name('destroy');
});
