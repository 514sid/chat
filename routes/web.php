<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
	Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('{all}', function() {
    return view('app');
})->where(['all' => '^(?!api/).*'])->name('app');