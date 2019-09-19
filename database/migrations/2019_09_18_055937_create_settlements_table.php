<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('terminal_id');
            $table->bigInteger('merchant_id')->nullable();
            $table->bigInteger('bank_id')->nullable();
            $table->string('filename')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->integer('row')->nullable();
            $table->bigInteger('manual')->default('0');
            $table->dateTime('settlement_created_at')->nullable();
            $table->string('upload_status')->nullable();
            $table->bigInteger('upload_by')->nullable();
            $table->dateTime('uploaded_at')->nullable();
            $table->tinyInteger('file_exist')->default('0');
            $table->tinyInteger('ok_exist')->default('0');
            $table->integer('row_check')->nullable();
            $table->longText('content')->nullable();
            $table->string('old_filename')->nullable();
            $table->dateTime('reuploaded_at')->nullable();
            $table->bigInteger('created_by')->nullable();
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
        Schema::dropIfExists('settlements');
    }
}
