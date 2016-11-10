<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'deposits', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('bank');
                $table->double('amount')->unsigned();
                $table->string('transaction_type');
                $table->string('voucher_img');
                $table->string('voucher_number');
                $table->string('origin_bank');
                $table->string('status');
                $table->string('IdPlayer');
                $table->integer('IdUser_reviewed')->nullable()->unsigned();
                $table->integer('IdUser_approved')->nullable()->unsigned();
                $table->string('payment_method')->nullable();
                $table->bigInteger('client_id')->unsigned();
                $table->timestamp('reviewed_at')->nullable();
                $table->timestamps();

                $table->foreign('IdUser_approved')->references('id')->on('users');
                $table->foreign('IdUser_reviewed')->references('id')->on('users');
                $table->foreign('client_id')->references('client_id')->on('apps');

            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
