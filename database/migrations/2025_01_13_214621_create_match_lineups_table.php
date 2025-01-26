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
        Schema::create('match_lineups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('formation')->nullable();
            $table->string('jersey_primary')->nullable();
            $table->string('number')->nullable();
            $table->string('jersey_outline')->nullable();
            $table->string('fancy_number')->nullable();
            $table->string('goalkeeper_jersey_primary')->nullable();
            $table->string('goalkeeper_number')->nullable();
            $table->string('goalkeeper_jersey_outline')->nullable();
            $table->string('goalkeeper_fancy_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_lineups');
    }
};
