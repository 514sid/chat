<?php

namespace App\Http\Controllers;

use App\Actions\Login;
use App\Actions\Logout;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
	public function login(
		LoginRequest $request,
		Login $action
	) {
		return $action($request->toData());
	}

	public function logout(
		Request $request,
		Logout $action
	) {
		return $action();
	}
}
