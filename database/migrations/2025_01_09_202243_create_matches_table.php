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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->integer('source_id');
            $table->string('customMatchId')->nullable();
            $table->foreignId('sport_id')->constrained();
            $table->foreignId('season_id')->constrained();
            $table->foreignId('home_team_id')->constrained('teams');
            $table->foreignId('away_team_id')->constrained('teams');
            $table->string('slug');
            $table->enum('round_type', ['league', 'cup', 'group', 'qualification'])->nullable();
            $table->string('round_name')->nullable(); //semifinal, final, qualification, qualification_round_2 etc
            $table->integer('round_number')->nullable();
            $table->dateTime('start_date');
            $table->string('status');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->foreignId('winner_id')->nullable()->constrained('teams');
            $table->foreignId('referee_id')->nullable()->constrained();
            $table->foreignId('venue_id')->nullable()->constrained();
            $table->dateTime('last_sync')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_events');
    }
};
