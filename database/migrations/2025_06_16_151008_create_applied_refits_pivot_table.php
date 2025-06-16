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
        Schema::create('applied_refits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_ship_id')->constrained('fleet_ship');
            $table->foreignId('ship_refit_id')->constrained('ship_refit');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applied_refits');
    }
};
