<?php

use App\Models\Chat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_history_items', function (Blueprint $table) {
            $table->id();
			$table->morphs('item', 'item');
			$table->foreignIdFor(Chat::class)->index()->constrained()->cascadeOnDelete();
			$table->timestamp('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_history_items');
    }
};
