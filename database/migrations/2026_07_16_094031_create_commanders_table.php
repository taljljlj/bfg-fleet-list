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
        Schema::create('commanders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('leadership')->nullable();
            $table->string('leadership_type')->nullable();
            $table->smallInteger('points');
            $table->string('rolls');
            $table->foreignId('faction_id')->constrained('factions');
            $table->foreignId('rule_id')->nullable()->constrained('rules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commanders');
    }
};
