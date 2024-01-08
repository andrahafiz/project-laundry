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
        Schema::create('profits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penjualan_bersih');
            $table->bigInteger('sewa_ruko');
            $table->bigInteger('beban_lain');
            $table->bigInteger('beban_air');
            $table->bigInteger('beban_listrik');
            $table->bigInteger('beban_gaji');
            $table->bigInteger('total_beban');
            $table->bigInteger('pajak');
            $table->bigInteger('laba_bersih');
            $table->date('periode')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profits');
    }
};
