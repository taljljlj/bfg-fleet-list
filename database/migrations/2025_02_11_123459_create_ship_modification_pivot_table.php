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
        Schema::create('ship_modification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')->constrained('ships');
            $table->foreignId('modification_id')->constrained('modifications');
            $table->foreignId('ship_refit_id')->constrained('ship_refit');
            $table->string('firepower', '10')->nullable();
            $table->smallInteger('range_speed')->nullable();
            $table->string('misc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_modification');
    }
};
