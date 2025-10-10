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
        Schema::create('ship_armament', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')->constrained('ships');
            $table->foreignId('armament_id')->constrained('armaments');
            $table->integer('range_speed')->nullable();
            $table->string('firepower', 25)->nullable();
            $table->string('misc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_armament');
    }
};
