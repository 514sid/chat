<?php

namespace App\Models;

use App\Enums\ChatStatus;
use App\Models\Bot;
use App\Enums\ChatType;
use App\Models\ChatHistoryItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
	use HasFactory;

	protected $table = 'chats';

	protected $fillable = [
		'bio',
		'type',
		'status',
		'username',
		'last_name',
		'first_name',
		'bot_id',
		'user_id',
		'telegram_chat_id',
	];

	protected $casts = [
		'type'   => ChatType::class,
		'status' => ChatStatus::class,
	];

	public function latestUpdate()
	{
		return $this->hasOne(ChatHistoryItem::class)->orderBy('id', 'desc')->latest();
	}

	public function history(): HasMany
	{
		return $this->hasMany(ChatHistoryItem::class);
	}

	public function bot(): BelongsTo
	{
		return $this->belongsTo(Bot::class);
	}

	public function scopeOrderByLatestUpdate($query, $direction = 'desc')
	{
		$query->orderBy(
			ChatHistoryItem::select('date')
				->whereColumn('chat_history_items.chat_id', 'chats.id')
				->latest()
				->take(1),
			$direction
		);
	}
}
