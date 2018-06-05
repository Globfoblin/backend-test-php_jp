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

$factory->define(App\Models\Message::class, function (Faker $faker) {
    $setHighlight = random_int(0, 1);
    $setParent = random_int(0, 1);
    $topics = \App\Models\Topic::all()->pluck('id')->toArray();
    $users = \App\Models\User::all()->pluck('id')->toArray();

    return [
        'topic_id' => $faker->randomElement($topics),
        'parent_id' => $setParent ? $faker->randomElement($topics) : 0,
        'body' => $faker->paragraph,
        'is_highlight' => $setHighlight,
        'user_id' => $faker->randomElement($users),
    ];
});
