<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use App\User;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
	    
    return [

        'name' => $faker->domainName(),
        'user_id' => User::all()->random()->id,
    ];
});