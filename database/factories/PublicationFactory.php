<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Publication;
use App\User;
use Faker\Generator as Faker;

$factory->define(Publication::class, function (Faker $faker) {
        $dt = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now');
        $date = $dt->format("Y-m-d");
    return [
        'title' => 'titulo de publicacion',
        'description' => $faker->text($maxNbChars = 30),
        
        'createDate' =>$date,
        'state' => 'disponible',
        //'user_id' => factory(User::class())->create()->id,
        'user_id' => User::all()->random()->id,
        'principalImage' => $faker -> imageUrl($width = 640, $height = 480),
    ];
});
