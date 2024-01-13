<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasjidIdToRamadhanTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ramadhan_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('masjid_id');

            // Foreign key constraint
            $table->foreign('masjid_id')->references('id')->on('masjids')->onDelete('cascade');
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
            $table->dropForeign(['masjid_id']);
            $table->dropColumn('masjid_id');
        });
    }
}