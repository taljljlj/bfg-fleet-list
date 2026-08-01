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
        Schema::create('fleet_list_commanders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_list_id')->constrained('fleet_lists');
            $table->foreignId('commander_id')->constrained('commanders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_list_commanders');
    }
};
