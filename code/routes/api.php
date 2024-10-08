<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\WordTypeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\v1\ConjugationTypeController;

Route::middleware(['auth:sanctum'])->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::group(
    [
    'prefix' => 'v1',
    'middleware' => [
        'auth:sanctum'
        ]
    ],
    function () {
        Route::get('/word-types', WordTypeController::class)->name('api.v1.word_types');
        Route::post('/register', [RegisteredUserController::class, 'store']);
        Route::get('/me', [UserController::class, 'me'])->name('api.v1.user.me');
        Route::get('/conjugation-types', [ConjugationTypeController::class, 'index'])->name('api.v1.conjugation_types');
    }
);
