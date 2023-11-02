<?php

namespace App\Models;

use App\Models\Chat;
use App\Enums\BotStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bot extends Model
{
    use HasFactory;

	protected $table = 'bots';

	protected $fillable = [
        'name',
        'token',
		'status',
        'offset',
        'username',
		'telegram_id',
		'description',
        'short_description',
		'updates_retrieved_at',
    ];

	protected $hidden = [
        'token',
    ];

	protected $casts = [
		'status'               => BotStatus::class,
		'updates_retrieved_at' => 'datetime',
    ];

	public function chats(): HasMany
    {
		return $this->hasMany(Chat::class);
    }
}