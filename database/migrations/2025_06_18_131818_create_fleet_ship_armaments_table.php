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
        Schema::create('fleet_ship_armaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_ship_id')->constrained('fleet_ship');
            $table->foreignId('ship_armament_id')->nullable()->default(null)->constrained('ship_armament');
            $table->string('type', 25);
            $table->string('placement', 25)->nullable()->default(null);
            $table->string('fire_arc', 25)->nullable()->default(null);
            $table->integer('range_speed')->nullable()->default(null);
            $table->integer('firepower')->nullable()->default(null);
            $table->string('misc')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_ship_armaments');
    }
};
