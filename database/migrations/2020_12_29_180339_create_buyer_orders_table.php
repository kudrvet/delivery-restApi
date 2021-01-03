<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('good_id');
            $table->foreign('good_id')
                ->references('id')->on('goods');

            $table->bigInteger('buyer_id');
            $table->foreign('buyer_id')
                ->references('id')->on('buyers');

            $table->integer('delivery_cost');



            $table->boolean('is_confirmed');

            $table ->bigInteger('courier_id');
            $table->foreign('courier_id')
                ->references('id')->on('couriers');


            $table->dateTime('delivery_time');

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
        Schema::dropIfExists('buyer_orders');
    }
}
