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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('nohp_customer')->nullable();
            $table->foreignId('user_id')->default(0);
            $table->foreignId('transactions_id')->default(0);
            $table->integer('jawaban1')->nullable();
            $table->integer('jawaban2')->nullable();
            $table->integer('jawaban3')->nullable();
            $table->integer('jawaban4')->nullable();
            $table->integer('jawaban5')->nullable();
            $table->boolean('expired')->default(0);
            $table->timestamps();

            $table->foreign('transactions_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('feedbacks');
    }
};
