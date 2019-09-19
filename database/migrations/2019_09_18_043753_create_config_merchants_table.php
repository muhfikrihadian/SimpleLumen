<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('merchant_id');
            $table->bigInteger('bank_id')->nullable();
            $table->string('host')->nullable();
            $table->integer('port')->nullable();
            $table->string('local_path')->nullable();
            $table->string('remote_path')->nullable();
            $table->string('pull_ext')->nullable();
            $table->integer('procode')->nullable();
            $table->enum('config_type', ['SETTLEMENT','VOID'])->nullable();
            $table->string('used_for')->nullable();
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
        Schema::dropIfExists('config_merchants');
    }
}
