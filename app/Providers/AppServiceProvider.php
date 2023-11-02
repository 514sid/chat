<?php

namespace App\Providers;

use App\Services\Telegram\TelegramApi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
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
