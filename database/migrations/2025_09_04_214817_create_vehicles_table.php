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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('chasis_number');
            $table->string('engine_number');
            $table->string('plate_number');
            $table->string('color');
            $table->year('launching_year');
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types');
            $table->foreignId('fuel_type_id')->constrained('fuel_types');
            $table->foreignId('vehicle_model_id')->constrained('vehicle_model');
            $table->enum('status', ['Excelente', 'Bueno', 'Regular', 'Malo'])->default('Excelente');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
