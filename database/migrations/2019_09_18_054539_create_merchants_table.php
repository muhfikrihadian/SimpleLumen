<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('group_id')->nullable();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('pic')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('file_forward')->default('1');
            $table->tinyInteger('auto_regist_terminal')->default('0');
            $table->bigInteger('created_by')->nullable();
            $table->tinyInteger('is_development')->default('1');
            $table->string('pic_email')->nullable();
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
        Schema::dropIfExists('merchants');
    }
}
