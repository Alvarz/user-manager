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
                $table->string('IdUser_reviewed')->nullable();
                $table->timestamps();

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
