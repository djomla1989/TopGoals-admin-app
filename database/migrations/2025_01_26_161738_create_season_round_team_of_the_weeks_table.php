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
        Schema::create('season_round_team_of_the_weeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_round_id')->constrained();
            $table->string('formation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_round_team_of_the_weeks');
    }
};
