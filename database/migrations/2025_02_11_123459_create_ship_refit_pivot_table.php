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
        Schema::create('ship_refit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')->constrained('ships');
            $table->foreignId('refit_id')->constrained('refits');
            $table->smallInteger('points');
            $table->smallInteger('firepower')->nullable();
            $table->smallInteger('range_speed')->nullable();
            $table->string('misc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_refit');
    }
};
