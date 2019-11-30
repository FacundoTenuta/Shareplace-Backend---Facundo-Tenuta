<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
        $dt = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now');
        $date = $dt->format("Y-m-d");
    return [
        'name' => $faker->name,
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'dni' => $faker->unique()->numberBetween($min = 12345678, $max = 40000000),
        
        'birthDate' => $date,
        // 'email_verified_at' => now(),
        'admin' => false,
        'enabled' => true,
        'password' => Hash::make('123456'), // password
        'remember_token' => Str::random(10),
        // 'image' => $faker -> imageUrl($width = 640, $height = 480),
        'image' => 'perfilGenerico.png',
        'description' => $faker->text($maxNbChars = 30),
    ];
});
