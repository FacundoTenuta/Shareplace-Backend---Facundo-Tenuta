<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Loan;
use App\Requestion;
use Faker\Generator as Faker;

$factory->define(Loan::class, function (Faker $faker) {
		$dt = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now');
        $date = $dt->format("Y-m-d");
        $dt2 = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now');
        $date2 = $dt2->format("Y-m-d");
    return [
    	
        'startDate' => $date,
        
        'endDate' => $date2,
        'requestion_id' => Requestion::all()->random()->id,
    ];
});
