<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('price');
            $table->unsignedBigInteger('category_id'); // ✅ Correct column
            $table->integer('quantity');
            $table->string('stock');
            $table->boolean('is_featured')->default(0);
            $table->timestamps();

            // ✅ Foreign key reference
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
