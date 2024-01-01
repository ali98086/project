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
        Schema::create('copans', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('amount')->comment('amount of discount');
            $table->tinyInteger('amount_type')->default(0)->comment('0 = percentage (%) and 1 = price unit');
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('discount_ceiling')->nullable()->comment('discount of ceiling');
            $table->tinyInteger('type')->default(0)->comment('0 = common (for all users) and 1 = private (for one user)');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copans');
    }
};
