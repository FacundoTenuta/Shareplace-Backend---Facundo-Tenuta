<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Publication;
use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
	    $dt = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now');
        $date = $dt->format("Y-m-d");
    return [

        'date' => $date,
        // 'publication_id' => factory(Publication::class())->create()->id,
        'publication_id' => Publication::all()->random()->id,
        'path' => $faker -> imageUrl($width = 640, $height = 480),
    ];
});
