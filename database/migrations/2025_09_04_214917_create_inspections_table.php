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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('customer_id')->constrained('employees');
            $table->boolean('has_scratches')->default(false);
            $table->enum('fuel_level', ['1/4', '1/2', '3/4', 'lleno']);
            $table->boolean('has_spare_tire')->default(false);
            $table->boolean('has_car_jack')->default(false);
            $table->boolean('has_glass_breakage')->default(false);
            $table->enum('front_left_tire', ['Buena', 'Regular', 'Mala'])->default('buena');
            $table->enum('front_right_tire', ['Buena', 'Regular', 'Mala'])->default('buena');
            $table->enum('rear_left_tire', ['Buena', 'Regular', 'Mala'])->default('buena');
            $table->enum('rear_right_tire', ['Buena', 'Regular', 'Mala'])->default('buena');
            $table->date('inspection_date');
            $table->foreignId('employee_id')->constrained('employees');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
