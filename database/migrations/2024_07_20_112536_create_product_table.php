<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id'); 
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('stock');
            $table->decimal('price');
            $table->decimal('sale_price')->nullable();
            $table->string('SKU');
            $table->unsignedInteger('quantity')->default(10);
            $table->string('rating')->nullable();
            $table->string('options')->nullable();
            $table->string('tags');
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->string('downloaded', 100)->nullable();
            $table->string('recommended', 100)->nullable();
            $table->string('condition', 100)->nullable();
            $table->string('status', 10);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
