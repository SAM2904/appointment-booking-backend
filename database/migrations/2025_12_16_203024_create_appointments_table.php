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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('client_email');
            $table->integer('status')->default(0)->comment('0:Scheduled 1:Completed 2:Cancelled 3:Admin Cancelled');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['start_at', 'end_at']); // I need it bcoz it can prevent me to insert duplicate bookings.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
