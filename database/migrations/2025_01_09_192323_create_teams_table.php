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
            $table->integer('source_id');
            $table->foreignId('sport_id')->constrained('sports');
            $table->string('name');
            $table->json('name_translation')->nullable();
            $table->string('name_code')->nullable();
            $table->string('slug');
            $table->boolean('is_national')->default(false);
            $table->char('gender')->default('M');
            $table->foreignId('manager_id')->nullable()->constrained('players');
            $table->foreignId('venue_id')->nullable()->constrained('venues');
            $table->boolean('is_active')->default(false);
            $table->timestamp('last_sync')->nullable();
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
