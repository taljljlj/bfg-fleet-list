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
        Schema::create('fleetlist_ships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_list_id')->constrained('fleet_lists');
            $table->foreignId('ship_id')->constrained('ships');
            $table->boolean('is_reserve')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_armaments_pivot');
    }
};
