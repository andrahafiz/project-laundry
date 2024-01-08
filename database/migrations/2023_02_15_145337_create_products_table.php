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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_product', '255');
            $table->string('slug')->unique();
            $table->foreignId('categories_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('stock')->default(0);
            $table->string('unit');
            $table->integer('price')->default(0);
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categories_id')
                ->references('id')
                ->on('categories')
                ->restrictOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
