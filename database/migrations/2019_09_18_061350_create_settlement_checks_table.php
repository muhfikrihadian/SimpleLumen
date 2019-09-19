<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bank_id')->nullable();
            $table->string('merchant_name');
            $table->string('merchant_bank_terminal_id');
            $table->string('filename');
            $table->integer('amount')->nullabel();
            $table->integer('row')->nullabel();
            $table->dateTime('bank_released_at')->nullabel();
            $table->dateTime('settle_created_at')->nullabel();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlement_checks');
    }
}
