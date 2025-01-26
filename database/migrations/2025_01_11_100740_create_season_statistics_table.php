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
        Schema::create('season_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained('seasons');
            $table->foreignId('tournament_id')->constrained('tournaments');
            $table->mediumInteger('goals')->unsigned()->default(0);
            $table->mediumInteger('home_team_wins')->unsigned()->default(0);
            $table->mediumInteger('away_team_wins')->unsigned()->default(0);
            $table->mediumInteger('draws')->unsigned()->default(0);
            $table->mediumInteger('yellow_cards')->unsigned()->default(0);
            $table->mediumInteger('red_cards')->unsigned()->default(0);
            $table->mediumInteger('number_of_rounds')->unsigned()->default(0);
            $table->mediumInteger('number_of_competitors')->unsigned()->default(0);
            $table->dateTime('last_sync')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_statistics');
    }
};
