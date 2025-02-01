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
        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('type');
            $table->smallInteger('hitpoints');
            $table->smallInteger('speed');
            $table->smallInteger('turns');
            $table->smallInteger('shields');
            $table->string('armour');
            $table->smallInteger('turrets');
            $table->smallInteger('points');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ships');
    }
};
