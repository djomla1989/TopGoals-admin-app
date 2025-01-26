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
        Schema::create('player_match_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_lineup_players_id')->constrained()->cascadeOnDelete();
            $table->foreignId('match_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->smallInteger('total_pass')->nullable();
            $table->smallInteger('accurate_pass')->nullable();
            $table->smallInteger('total_long_balls')->nullable();
            $table->smallInteger('accurate_long_balls')->nullable();
            $table->smallInteger('saved_shots_from_inside_the_box')->nullable();
            $table->smallInteger('saves')->nullable();
            $table->smallInteger('minute_played')->nullable();
            $table->smallInteger('touches')->nullable();
            $table->smallInteger('rating')->nullable();
            $table->smallInteger('possession_lost_ctrl')->nullable();
            $table->smallInteger('rating_versions_original')->nullable();
            $table->smallInteger('rating_versions_alternative')->nullable();
            $table->integer('goals_prevented')->nullable();
            $table->smallInteger('aerial_lost')->nullable();
            $table->smallInteger('aerial_won')->nullable();
            $table->smallInteger('duel_lost')->nullable();
            $table->smallInteger('duel_won')->nullable();
            $table->smallInteger('dispossessed')->nullable();
            $table->smallInteger('total_contest')->nullable();
            $table->smallInteger('big_chance_created')->nullable();
            $table->smallInteger('big_chance_missed')->nullable();
            $table->smallInteger('shot_off_target')->nullable();
            $table->smallInteger('on_target_scoring_attempt')->nullable();
            $table->smallInteger('hit_woodwork')->nullable();
            $table->smallInteger('goals')->nullable();
            $table->smallInteger('total_tackle')->nullable();
            $table->smallInteger('was_fouled')->nullable();
            $table->smallInteger('fouls')->nullable();
            $table->smallInteger('total_offside')->nullable();
            $table->smallInteger('minutes_played')->nullable();
            $table->integer('expected_goals')->nullable();
            $table->smallInteger('key_pass')->nullable();
            $table->smallInteger('penalty_miss')->nullable();
            $table->integer('expected_assists')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_match_statistics');
    }
};
