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
        Schema::rename('sports', 'sports_allsports');
        Schema::rename('categories', 'categories_allsports');
        Schema::rename('tournaments', 'tournaments_allsports');
        Schema::rename('tournament_seasons', 'tournament_seasons_allsports');
        Schema::rename('tournament_season_groups', 'tournament_season_groups_allsports');
        Schema::rename('tournament_season_next_events', 'tournament_season_next_events_allsports');
        Schema::rename('teams', 'teams_allsports');
        Schema::table('data_mappings', function (Blueprint $table) {
            $table->string('sportradar_table_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
