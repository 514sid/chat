<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotController;
use App\Http\Controllers\ChatController;
use App\Http\Resources\UserResource;

Route::get('/user', function (Request $request) {
	return $request->user() ? new UserResource($request->user()) : null;
});

Route::middleware(['auth:sanctum'])->group(function () {
	Route::post('/bot', [BotController::class, 'create']);

	Route::get('/chat/{chat}', [ChatController::class, 'chat']);

	Route::get('/chats', [ChatController::class, 'chats']);
});
