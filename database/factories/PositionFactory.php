<?php

use Faker\Generator as Faker;
use nojes\employees\Models\Position;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'title' => $faker->randomKey(EmployeePositionTableSeeder::$positionTitles)
    ];
});
