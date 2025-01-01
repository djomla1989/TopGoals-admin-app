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
        Schema::create('sports_sportradar', function (Blueprint $table) {
            $table->id();
            $table->string('import_id')->unique();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('categories_sportradar', function (Blueprint $table) {
            $table->id();
            $table->string('import_id')->unique();
            $table->string('name');
            $table->string('slug');
            $table->char('code', 3);
            $table->timestamps();
        });

        Schema::create('tournaments_sportradar', function (Blueprint $table) {
            $table->id();
            $table->string('import_id')->unique();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_id')->constrained('categories_sportradar');
            $table->timestamps();
        });

        Schema::table('data_mappings', function (Blueprint $table) {
            $table->integer('sportradar_table_id')->nullable()->after('oddsfeed_table_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
