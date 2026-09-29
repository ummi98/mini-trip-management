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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('passport_no');
            $table->date('passport_expiry')->nullable();
            $table->string('passport_file')->nullable();

            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();

            $table->timestamps();

            $table->unique(['booking_id', 'passport_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
