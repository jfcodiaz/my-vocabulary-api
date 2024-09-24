<?php

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\Words\StoreController as WordStoreCtrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'v1',
    'middleware'=> ['auth:sanctum']
    ], function () {

    Route::post('/words', [WordStoreCtrl::class, '__invoke']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/me', [UserController::class, 'me'])->name('api.v1.user.me');
});
