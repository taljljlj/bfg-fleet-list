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
        Schema::create('commander_rerolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commander_id')->constrained('commanders');
            $table->tinyInteger('modifier');
            $table->smallInteger('points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commander_rerolls');
    }
};
