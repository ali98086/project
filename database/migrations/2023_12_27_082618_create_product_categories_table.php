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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('parent_id')->nullable()->constrained('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('slug')->unique()->nullable();
            $table->text('tags');
            $table->tinyInteger('show_in_menu')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->text('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
