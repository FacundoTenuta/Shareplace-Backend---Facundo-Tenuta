<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Requestion;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Requestion::class, function (Faker $faker) {
        $dt = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now');
        $date = $dt->format("Y-m-d");
        $dt2 = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now');
        $date2 = $dt2->format("Y-m-d");

        $prestador = User::has('publications')->get()->random();
        $requester = User::all()->except($prestador->id)->random();
        
    return [

        

        'title' => 'titulo de publicacion',
        'reason' => $faker->text($maxNbChars = 10),       
        'fromDate' => $date,
        'untilDate' => $date2,
        'active' => true,
        'isLoan' => false,
        'startDate' => new Carbon(null),
        'endDate' => new Carbon(null),
        // 'publication_id' => factory(Publication::class())->create()->id;
        'publication_id' => $prestador->publications->random()->id,
        // 'requester_id' => factory(User::class())->create()->id;
        'requester_id' => $requester->id,

    ];
});
