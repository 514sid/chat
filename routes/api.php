<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotController;
use App\Http\Controllers\ChatController;

Route::post('/bot', [BotController::class, 'create']);

Route::get('/chats', [ChatController::class, 'get']);

Route::get('/ping', function () {
    return response()->json('pong', 200);
});
