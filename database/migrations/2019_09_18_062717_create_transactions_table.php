<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('merchant_id');
            $table->tinyInteger('bank_id');
            $table->bigInteger('terminal_id');
            $table->bigInteger('transaction_type_id')->nullable();
            $table->text('sam_report')->nullable();
            $table->string('card_no')->nullable();
            $table->dateTime('trx_created_at')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->bigInteger('prev_amount')->nullable();
            $table->tinyInteger('is_force')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
