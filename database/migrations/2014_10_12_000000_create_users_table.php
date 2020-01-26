<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            //controlar los tipos de datos

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastName');
            $table->string('email');
            $table->string('image')->nullable()->default('DefaultAvatar.png');
            $table->integer('dni')->unique()->unsigned();
            $table->date('birthDate')->nullable();
            $table->boolean('enabled')->default(true);
            $table->boolean('admin');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('description')->nullable();
        });

        // Schema::table('users', function ($table) {
        //     $table->string('api_token', 80)->after('password')
        //                         ->unique()
        //                         ->nullable()
        //                         ->default(null);
        // });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
