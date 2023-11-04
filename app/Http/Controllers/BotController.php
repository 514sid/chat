<?php

namespace App\Http\Controllers;

use App\Actions\GetBots;
use App\Actions\CreateBot;
use App\Http\Requests\GetBotsRequest;
use App\Http\Requests\CreateBotRequest;

class BotController extends Controller
{
	public function create(
		CreateBotRequest $request,
		CreateBot $action
	) {
		return $action($request->toData());
	}

	public function bots(
		GetBotsRequest $request,
		GetBots $action
	) {
		return $action();
	}
}
