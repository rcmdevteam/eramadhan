<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDakwahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('short_bio')->nullable();
            $table->text('why_sponsor_me')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('descriptions')->nullable();
            $table->timestamps();
        });

        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('descriptions')->nullable();
            $table->timestamps();
        });

        Schema::create('profile_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->integer('category_id');
            $table->timestamps();
        });

        Schema::create('profile_topics', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->integer('topic_id');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->integer('user_id');
            $table->decimal('grant_total', 8, 2);
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('topic_id');
            $table->integer('quantity');
            $table->decimal('subtotal', 8, 2);
            $table->char('status');
            $table->timestamps();
        });

        Schema::create('profile_sponsor', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->integer('user_id');
            $table->char('sponsor_type');
            $table->decimal('amount', 8, 2);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->char('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('profile_categories');
        Schema::dropIfExists('profile_topics');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('profile_sponsors');
    }
}
