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
        Schema::create('player_season_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained();
            $table->foreignId('season_id')->constrained();
            $table->integer('source_id');
            $table->string('type');
            $table->integer('appearances')->nullable();
            $table->integer('rating')->nullable();//int
            $table->integer('goals')->nullable();
            $table->integer('expected_goals')->nullable();//int
            $table->integer('assists')->nullable();
            $table->integer('expected_assists')->nullable();//int
            $table->integer('goals_assists_sum')->nullable();
            $table->integer('penalties_taken')->nullable();
            $table->integer('penalty_goals')->nullable();
            $table->integer('free_kick_taken')->nullable();//shotFromSetPiece
            $table->integer('free_kick_goal')->nullable();
            $table->integer('scoring_frequency')->nullable();
            $table->integer('total_shots')->nullable();
            $table->integer('shots_on_target')->nullable();
            $table->integer('big_chances_missed')->nullable();
            $table->integer('big_chances_created')->nullable();
            $table->integer('accurate_passes')->nullable();
            $table->integer('accurate_passes_percentage')->nullable();//int
            $table->integer('key_passes')->nullable();
            $table->integer('accurate_long_balls')->nullable();
            $table->integer('successful_dribbles')->nullable();
            $table->integer('successful_dribbles_percentage')->nullable();//int
            $table->integer('penalty_won')->nullable();
            $table->integer('tackles')->nullable();
            $table->integer('interceptions')->nullable();
            $table->integer('clearances')->nullable();
            $table->integer('possession_lost')->nullable();
            $table->integer('yellow_cards')->nullable();
            $table->integer('red_cards')->nullable();
            $table->integer('saves')->nullable();
            $table->integer('goals_prevented')->nullable();//int
            $table->integer('most_conceded')->nullable();
            $table->integer('least_conceded')->nullable();
            $table->integer('clean_sheet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_season_statistics');
    }
};
