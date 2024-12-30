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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 24)->comment('Name (max length = 24)');
            $table->string('email')->unique()->comment('Email address');
            $table->timestamp('email_verified_at')->nullable()->comment('Email verification timestamp');
            $table->string('password')->comment('Password (max length = 8, only numbers)');
            $table->rememberToken()->comment('Token for remembering user');
            $table->unsignedSmallInteger('uid')->nullable()->unique()->comment('Unique ID (max 65535)');
            $table->unsignedTinyInteger('role')->default(1)->comment('Role, default Util::LEVEL_USER');
            $table->boolean('is_finger_print_added')->default(0);
            $table->boolean('is_face_added')->default(0);
            $table->boolean('is_card_added')->default(0);
            $table->string('address', 100)->default('')->comment('Address (max length = 100)');
            $table->string('thana', 50)->default('')->comment('City (max length = 50)');
            $table->string('district', 50)->default('')->comment('State (max length = 50)');
            $table->string('is_active', 1)->default('1')->comment('Active status (1=active, 0=inactive)');
            $table->string('phone', 15)->default('0')->comment('Phone number (max length = 15, only numbers)');
            $table->string('cardno', 10)->default('0')->comment('Card number (max length = 10, only numbers)');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
