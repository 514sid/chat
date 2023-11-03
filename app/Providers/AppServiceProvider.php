<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Services\Telegram\TelegramApi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->bind(TelegramApi::class, function () {
			return new TelegramApi;
		});

		$this->app->bind(StatefulGuard::class, function () {
            return Auth::guard();
        });
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Model::shouldBeStrict();

        Relation::enforceMorphMap([
			'chat_status_update' => 'App\Models\ChatStatusUpdate',
        ]);
	}
}
