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
        Schema::create('fleet_commander', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->constrained('fleets');
            $table->foreignId('commander_id')->constrained('commanders');
            $table->foreignId('fleet_ship_id')->nullable()->constrained('fleet_ship');
            $table->smallInteger('points');
            $table->string('rolls');
            $table->foreignId('commander_reroll_id')->nullable()->constrained('commander_rerolls');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_commander');
    }
};
