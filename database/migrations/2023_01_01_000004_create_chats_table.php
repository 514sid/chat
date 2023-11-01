<?php

use App\Models\Bot;
use App\Models\User;
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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('telegram_chat_id');
			$table->string('type');
			$table->string('status');
			$table->string('username')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('bio')->nullable();
			$table->foreignIdFor(Bot::class)->nullable()->index()->constrained()->nullOnDelete();
			$table->foreignIdFor(User::class)->nullable()->index()->constrained()->nullOnDelete();
            $table->timestamps();

			$table->unique(['chat_id', 'bot_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
