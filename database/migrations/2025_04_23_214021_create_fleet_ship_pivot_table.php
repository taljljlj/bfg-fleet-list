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
        Schema::create('fleet_ship', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->constrained('fleets');
            $table->foreignId('ship_id')->constrained('ships');
            $table->smallInteger('points');
            $table->smallInteger('speed')->nullable();
            $table->smallInteger('turns')->nullable();
            $table->smallInteger('shields')->nullable();
            $table->string('armour')->nullable();
            $table->smallInteger('turrets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_ship');
    }
};
