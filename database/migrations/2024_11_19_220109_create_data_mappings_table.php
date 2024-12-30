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
        Schema::create('data_mappings', function (Blueprint $table) {
            $table->id();
            $table->integer('source_id');
            $table->integer('tipster_table_id');
            $table->string('table_name');
            $table->timestamps();
            $table->unique(['source_id', 'table_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mappings');
    }
};
