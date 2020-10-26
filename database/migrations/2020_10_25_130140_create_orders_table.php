<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_order');
            $table->dateTime('date_created_order');
            $table->dateTime('date_closed_order');
            $table->char('status_order',50);
            $table->float('total_amount_order',8,2);
            $table->char('currency_id',3);
            $table->char('first_name_order',100);
            $table->char('last_name_order',100);
            $table->bigInteger('shipping_id_order');
            $table->text('notes',500);
            $table->foreignId('intl_status');
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
        Schema::dropIfExists('ordenes');
    }
}
