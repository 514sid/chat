<?php

namespace App\Models;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatHistoryItem extends Model
{
    use HasFactory;

	protected $table = 'chat_history_items';

	protected $fillable = [
		'date',
		'chat_id',
        'item_id',
        'item_type',
    ];

	protected $casts = [
        'date' => 'datetime',
    ];

	public function chat(): BelongsTo
	{
		return $this->belongsTo(Chat::class);
	}

	public function item(): MorphTo
    {
        return $this->morphTo('item');
    }
}