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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->foreignId('user_id')->constrained('users');
            $table->bigInteger('id_card_number')->unique();
            $table->bigInteger('credit_card_number')->unique();
            $table->bigInteger('credit_limit');
            $table->enum('person_type', ['Física', 'Jurídica']);
            $table->string('driver_license_number')->unique();
            $table->date('driver_license_expiration_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
