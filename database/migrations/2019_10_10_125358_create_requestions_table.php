<?php

use Carbon\Carbon;
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
            $table->date('fromDate')->nullable()->default(new Carbon(null));
            $table->date('untilDate')->nullable()->default(new Carbon(null));
            $table->string('reason');
            $table->boolean('active');
            $table->boolean('isLoan');
            $table->date('startDate')->nullable()->default(new Carbon(null));
            $table->date('endDate')->nullable()->default(new Carbon(null));
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
        Schema::dropIfExists('requestions');
    }
}
