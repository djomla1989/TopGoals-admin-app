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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->integer('import_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->enum('gender', ['M', 'F', 'MIX'])->default('M');
            $table->foreignId('sport_id')->constrained();
            $table->foreignId('country_id')->constrained();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('type', ['league', 'knockout', 'tournament', 'cup', 'super-cup', 'friendly', 'qualifying_cup', 'qualifying_tournament'])->default('league');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
