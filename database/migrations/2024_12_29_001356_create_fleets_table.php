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
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('points')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->tinyInteger('is_public')->default(1);
            $table->foreignId('factions_id')->nullable()->constrained('factions');
            $table->foreignId('fleet_lists_id')->nullable()->constrained('fleet_lists');
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleets');
    }
};
