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
        Schema::create('season_standing_group_teams', function (Blueprint $table) {
            $table->id();
            $table->integer('source_id');//TODO: remove is not needed
            $table->foreignId('season_standing_group_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->smallInteger('position')->nullable();
            $table->smallInteger('points')->nullable();
            $table->smallInteger('matches')->nullable();
            $table->smallInteger('wins')->nullable();
            $table->smallInteger('draws')->nullable();
            $table->smallInteger('losses')->nullable();
            $table->smallInteger('scores_for')->nullable();
            $table->smallInteger('scores_against')->nullable();
            $table->string('scores_difference')->nullable();
            $table->string('promotion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_standing_group_teams');
    }
};
