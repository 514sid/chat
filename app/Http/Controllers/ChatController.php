<?php

namespace App\Http\Controllers;

use App\Actions\GetChats;
use App\Http\Requests\GetChatsRequest;

class ChatController extends Controller
{
	public function get(
		GetChatsRequest $request,
		GetChats $action
	) {
		return $action();
	}
}
