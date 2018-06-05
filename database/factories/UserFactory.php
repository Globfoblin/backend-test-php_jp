<?php

use Faker\Generator as Faker;

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    $setNickname = random_int(0, 2);
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'nickname' => $setNickname ? substr($faker->userName, 0, 20) : null,
        'password' => bcrypt('password'), // secret
        'remember_token' => str_random(10),
        'bio' => $faker->text,
    ];
});
