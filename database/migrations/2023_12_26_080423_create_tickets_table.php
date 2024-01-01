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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('seen')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('reference_id')->constrained('ticket_admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('tickets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('ticket_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('priority_id')->constrained('ticket_priorities')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
