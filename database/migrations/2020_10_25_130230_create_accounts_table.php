<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->char('nickname',50);
            $table->bigInteger('account_id')->nullable();
            $table->char('code',100)->nullable();
            $table->char('access_token',100)->nullable();
            $table->dateTime('tkdate')->nullable();
            $table->char('refresh_token',100)->nullable();
            $table->dateTime('rftdate')->nullable();
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
        Schema::dropIfExists('cuentas');
    }
}
