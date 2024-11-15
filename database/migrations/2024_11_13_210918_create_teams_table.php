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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
            $table->string('code');
            $table->string('slug');
            $table->integer('import_id');
            $table->foreignId('sport_id')->constrained('sports');
            $table->foreignId('country_id')->constrained();
            $table->foreignId('primary_tournament_id')->nullable()->constrained('tournaments');
            $table->boolean('is_national')->default(false);
            $table->enum('gender', ['M', 'F', 'MIX'])->default('M');
            $table->string('primary_color');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
