<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Condition;
use Faker\Generator as Faker;

$factory->define(Condition::class, function (Faker $faker) {
    return [
        'name' => $faker->text($maxNbChars = 30),
    ];
});
