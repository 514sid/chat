<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Actions\GetChat;
use App\Actions\GetChats;
use App\Actions\GetChatHistory;
use App\Http\Requests\GetChatRequest;
use App\Http\Requests\GetChatsRequest;
use App\Http\Requests\GetChatHistoryRequest;

class ChatController extends Controller
{
	public function chat(
		GetChatRequest $request,
		Chat $chat,
		GetChat $action
	) {
		return $action($chat);
	}

	public function chats(
		GetChatsRequest $request,
		GetChats $action
	) {
		return $action();
	}

	public function history(
		GetChatHistoryRequest $request,
		Chat $chat,
		GetChatHistory $action
	) {
		return $action($chat);
	}
}
