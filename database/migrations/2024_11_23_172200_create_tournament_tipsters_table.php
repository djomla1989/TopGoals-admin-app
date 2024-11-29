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
        Schema::create('tournament_tipsters', function (Blueprint $table) {
            $table->id();
            $table->integer('import_id')->unique();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_id')->constrained('categories_tipsters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_tipsters');
    }
};
