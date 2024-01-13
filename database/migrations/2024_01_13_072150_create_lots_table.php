<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->decimal('sasaran', 18, 2);
            $table->decimal('jumlah_lot', 18, 2);
            $table->unsignedBigInteger('masjid_id');
            $table->unsignedBigInteger('ramadhan_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('masjid_id')->references('id')->on('masjids')->onDelete('cascade');
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
        Schema::dropIfExists('lots');
    }
}