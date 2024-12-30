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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
           //  $table->integer('user_uid')->nullable()->comment('Machine ID');
            $table->integer('machine_id')->nullable()->comment('Machine ID');
            $table->string('attendance_type')->comment('Type of attendance');
            $table->date('date')->comment('Date of attendance');
            $table->time('time')->comment('Time of attendance');
            $table->string('attendances_by')->nullable()->comment('Fingerprint or Card or Face');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendences');
    }
};
