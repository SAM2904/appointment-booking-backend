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
        Schema::create('working_time_rules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('weekday_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->tinyInteger('is_active')->default(1)->comment('0:Inactive 1:Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_time_rules');
    }
};
