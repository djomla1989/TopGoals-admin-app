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
        Schema::create('match_additional_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches');
            $table->boolean('has_global_highlights')->default(false);
            $table->boolean('has_xg')->default(false);
            $table->boolean('has_event_player_statistics')->default(false);
            $table->boolean('has_event_player_heatmap')->default(false);
            $table->unsignedTinyInteger('winner_code')->nullable();
            $table->integer('injury_time1')->nullable();
            $table->integer('injury_time2')->nullable();
            $table->integer('home_score_period1')->default(0);
            $table->integer('home_score_period2')->default(0);
            $table->integer('home_score_normal_time')->default(0);
            $table->integer('away_score_period1')->default(0);
            $table->integer('away_score_period2')->default(0);
            $table->integer('away_score_normal_time')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_additional_data');
    }
};
