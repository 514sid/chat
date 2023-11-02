<?php

namespace App\Models;

use App\Models\Chat;
use App\Enums\ChatStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatStatusUpdate extends Model
{
    use HasFactory;

	protected $table = 'chat_status_updates';

	protected $fillable = [
		'status',
		'chat_id',
    ];

	protected $casts = [
        'status' => ChatStatus::class,
    ];

	public function chat(): BelongsTo
	{
		return $this->belongsTo(Chat::class);
	}
}
