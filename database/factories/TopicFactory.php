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

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sections = \App\Models\Section::all()->pluck('id')->toArray();
    $users = \App\Models\User::all()->pluck('id')->toArray();

    return [
        'section_id' => $faker->randomElement($sections),
        'title' => $faker->title,
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($users),
    ];
});
