<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMasjidsTableAddToyyibpayColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masjids', function (Blueprint $table) {
            $table->string('toyyibpay_secret_key')->nullable();
            $table->string('toyyibpay_collection_id')->nullable();
            $table->string('option_toyyibpay_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masjids', function (Blueprint $table) {
            $table->dropColumn('toyyibpay_secret_key');
            $table->dropColumn('toyyibpay_collection_id');
            $table->dropColumn('option_toyyibpay_type');
        });
    }
}