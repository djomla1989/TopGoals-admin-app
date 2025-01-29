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
        Schema::create('season_round_team_of_the_week_players', function (Blueprint $table) {
            $table->id();
            $table->integer('source_id');
            $table->unsignedBigInteger('season_round_team_of_the_week_id');
            $table->foreign('season_round_team_of_the_week_id', 'round_week_fk')
                ->references('id')
                ->on('season_round_team_of_the_weeks')
                ->onDelete('cascade');
            $table->foreignId('player_id')->constrained();
            $table->string('position');
            $table->smallInteger('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_round_team_of_the_week_players');
    }
};
