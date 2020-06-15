<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataModel\Model\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    $id = \App\DataModel\Model\Film::pluck('id')->toArray();
    return [
        'film_id' => $faker->randomElement($id),
        'user_id' => $faker->randomElement($users),
        'comment' => $faker -> paragraph,
        'status' => '1',
        'created_at' => now(),
    ];
});
