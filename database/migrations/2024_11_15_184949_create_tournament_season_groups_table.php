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
        Schema::create('tournament_season_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('import_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('group_name');
            $table->foreignId('tournament_id')->constrained();
            $table->foreignId('tournament_season_id')->constrained();
            $table->boolean('is_group');
            $table->integer('priority')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_season_groups');
    }
};
