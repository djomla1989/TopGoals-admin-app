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
        Schema::create('season_rounds', function (Blueprint $table) {
            $table->id();
            $table->integer('source_id');
            $table->foreignId('season_id')->constrained();
            $table->string('name');
            $table->string('slug');
            $table->integer('round_number');
            $table->dateTime('last_sync')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_rounds');
    }
};
