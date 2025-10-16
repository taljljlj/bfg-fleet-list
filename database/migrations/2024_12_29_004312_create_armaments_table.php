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
        Schema::create('armaments', function (Blueprint $table) {
            $table->id();
            $table->string('type', 55);
            $table->string('placement', 25)->nullable();
            $table->string('fire_arc', 25)->nullable();

            $table->unique(['type', 'placement', 'fire_arc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armaments');
    }
};
