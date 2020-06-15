<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataModel\Model\Film;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $id = \App\DataModel\Model\Film::pluck('id')->toArray();
    return [
        'film_id' => $faker->randomElement($id),
        'genre' => $faker -> numberBetween(1,9),
        'createrAt' => now(),
    ];
});
