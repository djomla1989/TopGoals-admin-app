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
        Schema::create('tournament_season_next_events', function (Blueprint $table) {
            $table->id();
            $table->string('customId');
            $table->string('slug');
            $table->integer('import_id');
            $table->string('home_team_name');
            $table->foreignId('home_team_id')->constrained('teams');
            $table->string('away_team_name');
            $table->foreignId('away_team_id')->constrained('teams');
            $table->integer('start_timestamp');
            $table->foreignId('tournament_season_id')->constrained();
            $table->foreignId('tournament_id')->constrained();
            $table->foreignId('tournament_season_group_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('sport_id')->constrained();
            $table->integer('round');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_season_next_events');
    }
};
