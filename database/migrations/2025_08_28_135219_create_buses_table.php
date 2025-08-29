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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_code')->unique();
            $table->string('registration_number')->unique();
            $table->string('bus_name');
            $table->string('bus_owner_info');
            $table->string('type');
            $table->integer('seat_capacity');
            $table->integer('available_seats')->nullable();
            $table->boolean('wifi')->default(0);
            $table->boolean('tv')->default(0);
            $table->boolean('ac')->default(0);
            $table->boolean('charging_port')->default(0);
            $table->boolean('washroom')->default(0);
            $table->string('status')->default('0');
            $table->date('fitness_expiry')->nullable();
            $table->string('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
