<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataModel\Model\Film;
use Faker\Generator as Faker;

$factory->define(Film::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'release' => $faker->name,
        'rating' => $faker->numberBetween(1,5),
        'ticket' => $faker->name,
        'price' => $faker->numberBetween(1, 1000),
        'country' => $faker->name,
        'photo' => $faker->image(dir('/filmImage')),
        'status' => 1,
        'created_at' => now(),
    ];
});
