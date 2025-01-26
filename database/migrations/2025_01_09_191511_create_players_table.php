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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->integer('source_id');
            $table->foreignId('sport_id')->constrained('sports');
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('slug');
            $table->string('country_code')->nullable();
            $table->char('position', 2)->nullable();
            $table->char('gender', 2)->default('M');
            $table->smallInteger('height')->nullable();
            $table->smallInteger('weight')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->integer('jersey_number')->nullable();
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
        Schema::dropIfExists('players');
    }
};
