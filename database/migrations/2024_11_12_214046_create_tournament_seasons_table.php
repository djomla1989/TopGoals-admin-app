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
        Schema::create('tournament_seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('year');
            $table->string('slug')->nullable();
            $table->integer('import_id')->nullable();
            $table->foreignId('tournament_id')->constrained();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_seasons');
    }
};
