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
        Schema::table('data_mappings', function (Blueprint $table) {
            $table->integer('ossport_table_id')->nullable()->after('id');
            $table->integer('source_id')->nullable()->change();//change this to all_sport_id
            $table->integer('tipster_table_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_mapper', function (Blueprint $table) {
            //
        });
    }
};
