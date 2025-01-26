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
        Schema::create('match_lineup_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_lineup_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->char('position', 2)->nullable();
            $table->smallInteger('jersey_number')->nullable();
            $table->boolean('is_captain')->default(false);
            $table->boolean('is_substitute')->default(false);
            $table->boolean('is_missing')->default(false);
            $table->string('missing_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_lineup_players');
    }
};
