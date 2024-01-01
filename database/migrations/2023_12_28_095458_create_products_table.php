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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('slug')->unique()->nullable();
            $table->text('image');
            $table->text('tags');
            $table->tinyInteger('status')->default(0);
            $table->decimal('weight', 10 , 2);
            $table->decimal('length', 10 , 1)->comment('unit = cm');
            $table->decimal('width', 10 , 1)->comment('unit = cm');
            $table->decimal('height', 10 , 1)->comment('unit = cm');
            $table->decimal('price', 20 , 3);
            $table->tinyInteger('marketable')->default(1)->comment('0 = unmarketable and 1 = marketable');
            $table->tinyInteger('marketable_number')->default(0);
            $table->tinyInteger('sold_number')->default(0);
            $table->tinyInteger('frozen_number')->default(0);
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
