<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title');
            $table->date('fromDate');
            $table->date('untilDate');
            $table->string('reason');
            $table->string('state');
            $table->unsignedBigInteger('publication_id');
            $table->unsignedBigInteger('requester_id');

            $table->foreign('publication_id')->references('id')->on('publications');
            $table->foreign('requester_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
