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
        Schema::create('tournament_additional_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('tournaments');
            $table->boolean('has_performance_graph_feature')->nullable();
            $table->integer('most_titles')->nullable();
            $table->foreignId('title_holder_id')->nullable()->constrained('teams');
            $table->string('primary_color_hex')->nullable();
            $table->string('secondary_color_hex')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_additional_data');
    }
};
