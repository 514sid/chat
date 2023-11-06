<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotController;
use App\Http\Controllers\ChatController;
use App\Http\Resources\UserResource;

Route::get('/user', function (Request $request) {
	$user = $request->user() ? new UserResource($request->user()) : null;

	return [
		'user' => $user
	];
});

Route::middleware(['auth:sanctum'])->group(function () {
	Route::get('/bots', [BotController::class, 'bots']);

	Route::post('/bots', [BotController::class, 'create']);

	Route::get('/chat/{chat}', [ChatController::class, 'chat']);

	Route::get('/chat/{chat}/history', [ChatController::class, 'history']);

	Route::get('/chats', [ChatController::class, 'chats']);
});
