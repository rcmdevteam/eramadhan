<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRamadhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramadhan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masjid_id');
            $table->integer('tahun');
            $table->timestamps();

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
        Schema::dropIfExists('ramadhan');
    }
}