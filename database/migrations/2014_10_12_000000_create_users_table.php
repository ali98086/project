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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('national_code')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('slug')->unique()->nullable();
            $table->tinyInteger('activation')->default(0)->comment('0 = inactive and 1 = active');
            $table->timestamp('activation_date')->nullable();
            $table->text('profile_photo_path')->nullable()->comment('avatar photo');
            $table->tinyInteger('user_type')->default(0)->comment('0 = user and 1 = admin');
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
