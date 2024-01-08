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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->integer('total_price');
            $table->integer('money')->default(0);
            $table->integer('change')->default(0);
            $table->integer('payment_method')->default(0)->comment("0:cash 1:tf");
            $table->integer('order_type')->comment("0: self 1:antar jemput");
            $table->integer('status_transactions')->default(0);
            $table->string('transfer_proof')->default('avatar.jpg');;
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')
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
        Schema::dropIfExists('transactions');
    }
};
