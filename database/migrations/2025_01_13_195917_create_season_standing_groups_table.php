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
        Schema::create('season_standing_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('source_id');//TODO: remove is not needed
            $table->foreignId('season_standing_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('tie_breaking_rule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_standing_groups');
    }
};
