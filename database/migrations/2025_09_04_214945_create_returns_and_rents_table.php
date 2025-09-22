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
        Schema::create('returns_and_rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->date('rent_date');
            $table->date('return_date');
            $table->bigInteger('amount_per_day');
            $table->text('comments')->nullable();
            $table->enum('status', ['Reservado', 'Devuelto', 'Cancelado'])->default('Reservado');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
