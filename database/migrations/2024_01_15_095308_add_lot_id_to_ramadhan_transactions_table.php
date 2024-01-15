<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLotIdToRamadhanTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ramadhan_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('lot_id')->nullable();

            // Foreign key constraint
            $table->foreign('lot_id')->references('id')->on('lots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ramadhan_transactions', function (Blueprint $table) {
            $table->dropForeign(['lot_id']);
            $table->dropColumn('lot_id');
        });
    }
}