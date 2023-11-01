<?php

namespace App\Http\Controllers;

use App\Actions\CreateBot;
use App\Http\Requests\CreateBotRequest;
use App\Http\Resources\BotResource;

class BotController extends Controller
{
	public function create(
		CreateBotRequest $request,
		CreateBot $action
	) {
		return $action($request->toData());
	}
}
