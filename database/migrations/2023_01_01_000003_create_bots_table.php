<?php

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
        Schema::create('bots', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('username', 32);
            $table->string('description', 512)->nullable();
            $table->string('short_description', 120)->nullable();
            $table->string('token')->unique()->index();
            $table->bigInteger('offset')->default(0);
			$table->timestamp('updates_retrieved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bots');
    }
};
