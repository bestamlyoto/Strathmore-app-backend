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
        Schema::create('energy_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Solar, Wind, Hydro, etc.
            $table->string('color')->default('#27ae60'); // For map visualization
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energy_types');
    }
};
