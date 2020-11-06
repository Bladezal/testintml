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
            $table->float('total_amount_order',8,2);
            $table->char('reason_order',250)->nullable();
            $table->char('first_name_order',100);
            $table->char('last_name_order',100);
            $table->char('shipping_type_order',100)->nullable();
            $table->text('detail_order')->nullable();
            $table->text('notes',500)->nullable();
            $table->foreignId('intl_status')->nullable();
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
