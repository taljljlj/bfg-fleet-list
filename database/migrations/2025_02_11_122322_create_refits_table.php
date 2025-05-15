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
        Schema::create('refits', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('text', 75);
            $table->text('text_long')->nullable();
            $table->string('module1', 50);
            $table->string('action1', 50)->nullable();
            $table->string('value1', 50)->nullable();
            $table->string('module2', 50)->nullable();
            $table->string('action2', 50)->nullable();
            $table->string('value2', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refits');
    }
};
