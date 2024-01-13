<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRamadhanTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramadhan_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('emel');
            $table->string('telefon');
            $table->string('ramadhan');
            $table->decimal('jumlah');
            $table->integer('kuantiti');
            $table->string('toyyibpay_ref');
            $table->string('status');
            $table->unsignedBigInteger('ramadhan_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('ramadhan_id')->references('id')->on('ramadhan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ramadhan_transactions');
    }
}