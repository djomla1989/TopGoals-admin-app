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
            $table->integer('source_id');
            $table->foreignId('sport_id')->constrained('sports');
            $table->string('name');
            $table->json('name_translation')->nullable();
            $table->string('slug');
            $table->foreignId('category_id')->constrained('categories');
            $table->char('gender')->default('M');
            $table->smallInteger('tier')->nullable();
            $table->boolean('is_national')->default(false);
            $table->boolean('has_groups')->default(false);
            $table->string('age_group')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_sync')->nullable();
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
