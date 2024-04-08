<?php

use App\Models\User\User;
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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('token')->comment('token for authentication after register');
            $table->foreignId('user_id')->constrained('users');
            $table->string('otp_code')->comment('this code is send to mobile number or email');
            $table->string('login_field')->comment('mobile or email is received than user');
            $table->tinyInteger('type')->default(0)->comment('0 = mobile and 1 = mobile number');
            $table->tinyInteger('used')->default(0)->comment('0 = not used and 1 = used');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
