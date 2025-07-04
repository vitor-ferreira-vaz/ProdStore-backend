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
        Schema::create('image_product', function (Blueprint $table) {
            $table->id();
            $table->string('filepath');
            $table->string('filename');
            $table->string('file_extension');
            $table->string('disk');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('product_id', 'fk_product_x_img')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_product');
    }
};
