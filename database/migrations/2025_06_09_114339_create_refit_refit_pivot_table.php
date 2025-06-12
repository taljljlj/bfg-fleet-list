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
        Schema::create('refit_refit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('refits');
            $table->foreignId('child_id')->constrained('refits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refit_refit');
    }
};
