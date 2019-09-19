<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('merchant_id')->nullable();
            $table->string('name');
            $table->text('remarks')->nullable();
            $table->integer('terminal_limit');
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('location_id')->nullable();
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
        Schema::dropIfExists('terminals');
    }
}
